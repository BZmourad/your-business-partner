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
use App\Models\Document\DocumentComment;
use App\Repositories\TimelineRepository;
use App\Models\User;

class DocumentRepository
{
    protected $timelineRepository;
    protected $users;

    public function __construct(TimelineRepository $timelineRepository){
        $this->timelineRepository = $timelineRepository;
    }

    public function sendManyEmail(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'document_id' => 'required|exists:documents,id',
                'emailfrom' => 'required|email',
                'emailTo' => 'nullable|array',
                'emailTo.*.name' => 'required|email',
                'emailSubject' => 'required|string|min:5',
                'message' => 'required|string|min:10',
                'documents.*' => [
                    'nullable',
                    'file',
                    'mimetypes:application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,image/png,image/jpeg',
                    'max:5120'
                ],
            ]);
            if ($validator->fails()) {
                return ['error' => $validator->errors()->first()];
            }
            $document = Document::with(['request.service', 'request.customer'])->findOrFail($request->document_id);
            $attachments = [];
            foreach ($document->getMedia("*") as $file) {
                $filePath = $file->getPath();
                if (!file_exists($filePath)) {
                    \Log::warning("Fichier non trouvé: " . $filePath);
                    continue;
                }
                $attachments[] = [
                    'file' => $filePath, 
                    'options' => [
                        'as' => $file->file_name,
                        'mime' => $file->mime_type
                    ]
                ];
            }
            if ($request->hasFile('documents')) {
                foreach ($request->file('documents') as $file) {
                    $attachments[] = [
                        'file' => $file->getRealPath(),
                        'options' => [
                            'as' => $file->getClientOriginalName(), 
                            'mime' => $file->getMimeType()
                        ]
                    ];
                }
            }
            if ($request->has('emailTo')) {
                foreach ($request->emailTo as $emailTo) {
                    $mail = new DocumentMail($request->emailSubject, $request->message, $document, $attachments);
                    Mail::to($emailTo['name'])->send($mail);
                }
            }
            $this->users = User::permission($document->request?->service->slug ?? '')->get();
            $this->timelineRepository->newTimeline('email', 'document', $document->id, $document->reference, $this->users);
            return ['success' => __('Action successfully completed.')];
        } catch (\Exception $e) {
            elog($e);
            return ['error' => __('Une erreur est survenue. Veuillez réessayer.')];
        }
    }

    public function delete($id){
        try {
            DB::beginTransaction();
            $document = Document::findOrFail($id);
            $i = $document->id;
            $r = $document->reference;
            $s = $document->request?->service->slug ?? '';
            foreach ($document->getMedia("*") as $media) {
                $document->deleteMedia($media->id);
            }
            $document->delete();
            $this->users = User::permission($s)->get();
            $this->timelineRepository->newTimeline('delete', 'document', $i, $r, $this->users);
            DB::commit();
            return ['success' => __('Action successfully completed.')];
        } catch (\Exception $e) {
            DB::rollBack();
            elog($e);
            return ['error' => __('Une erreur est survenue. Veuillez réessayer.')];
        }
    }

    public function deleteMedia($id){
        try {
            DB::beginTransaction();
            $media = Media::findOrFail($id);
            $document = Document::findOrFail($media->model_id);
            $document->deleteMedia($id);
            $this->users = User::permission($document->request?->service->slug ?? '')->get();
            $this->timelineRepository->newTimeline('delete_media', 'document', $document->id, $document->reference, $this->users);
            DB::commit();
            return ['success' => __('Action successfully completed.')];
        } catch (\Exception $e) {
            DB::rollBack();
            elog($e);
            return ['error' => __('Une erreur est survenue. Veuillez réessayer.')];
        }
    }

    public function uploadMedia(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required|exists:documents,id',
                'documents.*' => [
                    'nullable',
                    'file',
                    'mimetypes:application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,image/png,image/jpeg',
                    'max:5120'
                ],
            ]);
            if ($validator->fails()) {
                return ['error' => $validator->errors()->first()];
            }
            DB::beginTransaction();
            $document = Document::findOrFail($request->id);
            if ($request->has('documents')) {
                $i = 0;
                foreach ($request->documents as $file) {
                    if ($file->isValid()) {
                        $i += 1;
                    }
                }
                $i = $i + $document->maxCollectionName();
                foreach ($request->documents as $file) {
                    if ($file->isValid()) {
                        $x = $document->addDocument($file, $i);
                        //wlog('media: '.$x->id);
                    }
                }
            }
            $this->users = User::permission($document->request?->service->slug ?? '')->get();
            $this->timelineRepository->newTimeline('upload_media', 'document', $document->id, $document->reference, $this->users);
            DB::commit();
            return ['success' => __('Action successfully completed.')];
        } catch (\Exception $e) {
            elog($e);
            DB::rollBack();
            return ['error' => __('Une erreur est survenue. Veuillez réessayer.')];
        }
    }

    public function comment(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'document_id' => 'required|exists:documents,id',
                'user_id' => 'required|exists:users,id',
                'is_visible' => 'nullable|boolean',
                'comment' => 'required|string',
            ]);
            if ($validator->fails()) {
                return ['error' => $validator->errors()->first()];
            }
            DB::beginTransaction();
            $document = Document::findOrFail($request->document_id);
            DocumentComment::create([
                'document_id' => $request->document_id,
                'user_id' => $request->user_id,
                'is_visible' => $request->is_visible??false,
                'comment' => $request->comment,
            ]);
            $this->users = User::permission($document->request?->service->slug ?? '')->get();
            $this->timelineRepository->newTimeline('comment', 'document', $document->id, $document->reference, $this->users);
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
            $comment = DocumentComment::findOrFail($id);
            $r = $comment->document->reference;
            $i = $comment->document->id;
            $s = $document->request?->service->slug ?? '';
            $comment->delete();
            $this->users = User::permission($s)->get();
            $this->timelineRepository->newTimeline('delete_comment', 'document', $i, $r, $this->users);
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
            $comment = DocumentComment::findOrFail($id);
            $r = $comment->document->reference;
            $i = $comment->document->id;
            $comment->update(['is_visible' => !$comment->is_visible]);
            $this->users = User::permission($comment->document->request?->service->slug ?? '')->get();
            $this->timelineRepository->newTimeline($comment->is_visible ? 'visible_comment' : 'invisible_comment', 'document', $i, $r, $this->users);
            DB::commit();
            return ['success' => __('Action successfully completed.')];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['error' => __('Une erreur est survenue. Veuillez réessayer.')];
        }
    }

    public function addDocument(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'request_id' => 'nullable|exists:requests,id',
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'documents.*' => [
                    'nullable',
                    'file',
                    'mimetypes:application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,image/png,image/jpeg',
                    'max:5120'
                ],
            ]);
            if ($validator->fails()) {
                return ['error' => $validator->errors()->first()];
            }
            DB::beginTransaction();
            $document = Document::create([
                'request_id' => $request->request_id,
                'name' => $request->name,
                'description' => $request->description,
                'created_by' => auth()->id()??null
            ]);
            $document->update(['reference'=>getRefrence($document->id, "DC")]);
            if ($request->has('documents')) {
                $i = 1;
                foreach ($request->documents as $file) {
                    if ($file->isValid()) {
                        $document->addDocument($file, $i);
                        $i += 1;
                    }
                }
            }
            $this->users = User::permission($document->request?->service->slug ?? '')->get();
            $this->timelineRepository->newTimeline('create', 'document', $document->id, $document->reference, $this->users);
            DB::commit();
            return ['success' => __('Action successfully completed.'), 'id' => $document->id];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['error' => __('Une erreur est survenue. Veuillez réessayer.')];
        }
    }

    public function editDocument(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required|exists:documents,id',
                'request_id' => 'nullable|exists:requests,id',
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
            ]);
            if ($validator->fails()) {
                return ['error' => $validator->errors()->first()];
            }
            DB::beginTransaction();
            $document = Document::findOrFail($request->id);
            $document->update([
                'request_id' => $request->request_id,
                'name' => $request->name,
                'description' => $request->description,
            ]);
            $this->users = User::permission($document->request?->service->slug ?? '')->get();
            $this->timelineRepository->newTimeline('edit', 'document', $document->id, $document->reference, $this->users);
            DB::commit();
            return ['success' => __('Action successfully completed.')];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['error' => __('Une erreur est survenue. Veuillez réessayer.')];
        }
    }

    public function setMonth(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required|exists:documents,id'
            ]);
            if ($validator->fails()) {
                return ['error' => $validator->errors()->first()];
            }
            DB::beginTransaction();
            $document = Document::findOrFail($request->id);
            $document->update([
                'month' => $request->month,
                'year' => $request->year,
            ]);
            $this->users = User::permission($document->request?->service->slug ?? '')->get();
            $this->timelineRepository->newTimeline(($request->month || $request->year) ? 'attach_month' : 'dettach_month', 'document', $document->id, $document->reference, $this->users);
            DB::commit();
            return ['success' => __('Action successfully completed.')];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['error' => __('Une erreur est survenue. Veuillez réessayer.')];
        }
    }
    
}