<?php
namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Request\Request as ServiceRequest;
use App\Models\Service\ServiceDocument;
use App\Models\Service\ServiceFormField;
use App\Models\Document\Document;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Carbon\Carbon;
use App\Models\Request\RequestField;
use Illuminate\Support\Facades\Mail;
use App\Mail\DocumentMail;
use App\Models\Request\RequestComment;
use App\Repositories\TimelineRepository;
use App\Models\Request\RequestStatus;
use App\Models\User;

class RequestRepository
{
    protected $timelineRepository;
    protected $users;

    public function __construct(TimelineRepository $timelineRepository){
        $this->timelineRepository = $timelineRepository;
    }

    public function addServiceRequest(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'customer_id' => 'required|exists:customers,id',
                'service_id' => 'required|exists:services,id',
                'notes' => 'nullable|string',
                'documents.*.*' => [
                    'nullable',
                    'file',
                    'mimetypes:application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,image/png,image/jpeg',
                    'max:5120'
                ],
                'fields.*' => 'nullable'
            ]);
            if ($validator->fails()) {
                return ['error' => $validator->errors()->first()];
            }
            DB::beginTransaction();
            $serviceRequest = ServiceRequest::create([
                'customer_id' => $request->customer_id,
                'service_id' => $request->service_id,
                'notes' => $request->notes,
                'status' => 'pending',
                'created_by' => auth()->id()
            ]);
            $serviceRequest->update(['reference'=>getRefrence($serviceRequest->id, "RQ")]);
            if ($request->has('fields')) {
                foreach ($request->fields as $fieldId => $value) {
                    $sf = ServiceFormField::findOrFail($fieldId);
                    if ($sf) {
                        $serviceRequest->fields()->create([
                            'response' => is_array($value) ? json_encode($value) : $value,
                            'name' => $sf->name,
                            'description' => $sf->description,
                            'type' => $sf->type,
                            'options' => $sf->options,
                            'is_required' => $sf->is_required,
                        ]);
                    } else {
                        DB::rollBack();
                        return ['error' => __('Une erreur est survenue. Veuillez réessayer.')];
                    }
                }
            }
            if ($request->has('documents')) {
                foreach ($request->documents as $documentId => $files) {
                    $i = 0;
                    foreach ($files as $file) {
                        if ($file->isValid()) {
                            $i += 1;
                        }
                    }
                    if ($i != 0) {
                        $sd = ServiceDocument::findOrFail($documentId);
                        if ($sd) {
                            $requestDocument = $serviceRequest->documents()->create([
                                'name' => $sd->name,
                                'description' => $sd->description,
                                'is_required' => $sd->is_required
                            ]);
                            $requestDocument->update(['reference'=>getRefrence($requestDocument->id, "DC")]);
                            foreach ($files as $file) {
                                if ($file->isValid()) {
                                    $requestDocument->addDocument($file, $i);
                                }
                            }
                        } else {
                            DB::rollBack();
                            return ['error' => __('Une erreur est survenue. Veuillez réessayer.')];
                        }
                    }
                }
            }
            $serviceRequest->histo()->create([
                'status' => 'pending',
                'created_by' => auth()->user()->id??null
            ]);
            $this->users = User::permission($serviceRequest->service->slug)->get();
            $this->timelineRepository->newTimeline('create', 'request', $serviceRequest->id, $serviceRequest->reference, $this->users);
            DB::commit();
            return ['success' => __('Demande créé avec succès.'), 'id' => $serviceRequest->id];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['error' => __('Une erreur est survenue. Veuillez réessayer.')];
        }
    }

    public function deleteServiceRequest(ServiceRequest $serviceRequest){
        try {
            DB::beginTransaction();
            $r = $serviceRequest->reference;
            $i = $serviceRequest->id;
            $s = $serviceRequest->service->slug;
            Document::where('request_id', $serviceRequest->id)->delete();
            RequestField::where('request_id', $serviceRequest->id)->delete();
            RequestStatus::where('request_id', $serviceRequest->id)->delete();
            RequestComment::where('request_id', $serviceRequest->id)->delete();
            $serviceRequest->delete();
            $this->users = User::permission($s)->get();
            $this->timelineRepository->newTimeline('delete', 'request', $i, $r, $this->users, $this->users);
            DB::commit();
            return ['success' => __('Demande supprimé avec succès.')];
        } catch (\Exception $e) {
            elog($e);
            DB::rollBack();
            return ['error' => __('Une erreur est survenue. Veuillez réessayer.')];
        }
    }

    public function setStatusRequest(Request $request){
        try {
            DB::beginTransaction();
            $serviceRequest = ServiceRequest::findOrFail($request->id);
            $serviceRequest->update([
                'status' => $request->status,
            ]);
            $serviceRequest->histo()->create([
                'status' => $request->status,
                'notes' => $request->notes,
                'created_by' => auth()->id()??null
            ]);
            $this->users = User::permission($serviceRequest->service->slug)->get();
            $this->timelineRepository->newTimeline($request->status, 'request', $serviceRequest->id, $serviceRequest->reference, $this->users);
            DB::commit();
            return ['success' => __('Action successfully completed.')];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['error' => __('Une erreur est survenue. Veuillez réessayer.')];
        }
    }

    public function setPaidStatusRequest(Request $request){
        try {
            DB::beginTransaction();
            $serviceRequest = ServiceRequest::findOrFail($request->id);
            $serviceRequest->update([
                'paid_status' => $request->status,
            ]);
            $serviceRequest->histo()->create([
                'status' => $request->status,
                'notes' => $request->notes,
                'created_by' => auth()->id()??null
            ]);
            $this->users = User::permission($serviceRequest->service->slug)->get();
            $this->timelineRepository->newTimeline($request->status, 'request', $serviceRequest->id, $serviceRequest->reference, $this->users);
            DB::commit();
            return ['success' => __('Action successfully completed.')];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['error' => __('Une erreur est survenue. Veuillez réessayer.')];
        }
    }

    public function updateForm(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'request_id' => 'required|exists:requests,id',
                'fields.*' => 'nullable'
            ]);
            if ($validator->fails()) {
                return ['error' => $validator->errors()->first()];
            }
            DB::beginTransaction();
            $r = ServiceRequest::findOrFail($request->request_id);
            if ($request->has('fields')) {
                foreach ($request->fields as $fieldId => $value) {
                    RequestField::findOrFail($fieldId)->update([
                        'response' => is_array($value) ? json_encode($value) : $value,
                    ]);
                }
            }
            $this->users = User::permission($r->service->slug)->get();
            $this->timelineRepository->newTimeline('update_form', 'request', $r->id, $r->reference, $this->users);
            DB::commit();
            return ['success' => __('Action successfully completed.')];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['error' => __('Une erreur est survenue. Veuillez réessayer.')];
        }
    }

    public function comment(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'request_id' => 'required|exists:requests,id',
                'user_id' => 'required|exists:users,id',
                'is_visible' => 'nullable|boolean',
                'comment' => 'required|string',
            ]);
            if ($validator->fails()) {
                return ['error' => $validator->errors()->first()];
            }
            DB::beginTransaction();
            $r = ServiceRequest::findOrFail($request->request_id);
            RequestComment::create([
                'request_id' => $request->request_id,
                'user_id' => $request->user_id,
                'is_visible' => $request->is_visible??false,
                'comment' => $request->comment,
            ]);
            $this->users = User::permission($r->service->slug)->get();
            $this->timelineRepository->newTimeline('comment', 'request', $r->id, $r->reference, $this->users);
            DB::commit();
            return ['success' => __('Action successfully completed.')];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['error' => __('Une erreur est survenue. Veuillez réessayer.')];
        }
    }

    public function deleteComment($id){
        try {
            DB::beginTransaction();
            $comment = RequestComment::findOrFail($id);
            $r = $comment->request->reference;
            $i = $comment->request->id;
            $s = $comment->request->service->slug;
            $comment->delete();
            $this->users = User::permission($s)->get();
            $this->timelineRepository->newTimeline('delete_comment', 'request', $i, $r, $this->users);
            DB::commit();
            return ['success' => __('Action successfully completed.')];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['error' => __('Une erreur est survenue. Veuillez réessayer.')];
        }
    }

    public function visibleComment($id){
        try {
            DB::beginTransaction();
            $comment = RequestComment::findOrFail($id);
            $r = $comment->request->reference;
            $i = $comment->request->id;
            $comment->update(['is_visible' => !$comment->is_visible]);
            $this->users = User::permission($comment->request->service->slug)->get();
            $this->timelineRepository->newTimeline($comment->is_visible ? 'visible_comment' : 'invisible_comment', 'request', $i, $r, $this->users);
            DB::commit();
            return ['success' => __('Action successfully completed.')];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['error' => __('Une erreur est survenue. Veuillez réessayer.')];
        }
    }
    
}