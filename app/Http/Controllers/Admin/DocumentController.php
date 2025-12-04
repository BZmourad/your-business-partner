<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use App\Models\Document\Document;
use App\Repositories\DocumentRepository;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Permission\Permission;
use App\Models\Document\DocumentPermission;
use App\Models\Request\Request as ServiceRequest;
use App\Models\Customer\Customer;
use App\Models\Service\Service;
use App\Repositories\TimelineRepository;

class DocumentController extends Controller
{
    protected $timelineRepository;
    protected $users;

    public function __construct(TimelineRepository $timelineRepository){
        $this->timelineRepository = $timelineRepository;
    }

    public function index(Request $request) {
        $requests = ServiceRequest::all();
        $customers = Customer::all();
        if(request()->ajax()) {
            $allowedServices = Service::get()->filter(function ($service) {
                return auth()->user()->can($service->slug);
            })->pluck('id');
            $query = Document::query()->with(['request', 'request.customer', 'request.service', 'permissions'])->whereHas('request', function($q) use ($allowedServices) {
                $q->whereIn('service_id', $allowedServices);
            });
            $orderColumn = $request->input('order.0.column');
            $orderDirection = $request->input('order.0.dir');
            $columns = [
                'id',
                'request_id',
                'request.customer.id',
                'name',
                'month',
                'created_at',
                'action',
            ];
            if ($request->has('customer_id') && !empty($request->customer_id)) {
                $query->whereHas('request.customer', function($q) use ($request) {
                    $q->where('id', $request->customer_id);
                });
            }
            if ($request->has('request_id') && !empty($request->request_id)) {
                $query->where('request_id', $request->request_id);
            }
            if ($request->has('month') && !empty($request->month)) {
                $query->where('month', $request->month);
            }
            if ($request->has('year') && !empty($request->year)) {
                $query->where('year', $request->year);
            }
            if ($orderColumn !== null && isset($columns[$orderColumn])) {
                if ($columns[$orderColumn] == 'month') {
                    $query->orderBy('year', $orderDirection)->orderBy('month', $orderDirection);
                } else {
                    $query->orderBy($columns[$orderColumn], $orderDirection);
                }
            } else {
                $query->orderBy('id', 'desc');
            }
            return DataTables::of($query)
                ->addColumn('demande', function ($data) {
                    return view('admin.documents.partials.request', [ 'data' => $data ]);
                })->addColumn('customer', function ($data) {
                    return view('admin.documents.partials.customer', [ 'data' => $data ]);
                })->addColumn('name', function ($data) {
                    return view('admin.documents.partials.name', [ 'data' => $data ]);
                })->addColumn('month', function ($data) {
                    return view('admin.documents.partials.month', [ 'data' => $data ]);
                })->addColumn('action', function ($data) {
                    return view('admin.documents.partials.action', [ 'data' => $data ]);
                })->filter(function ($query) use ($request) {
                    if ($request->has('search') && !empty($request->search['value'])) {
                        $search = $request->search['value'];
                        $query->where(function ($q) use ($search) {
                            $q->where('reference', 'like', "%{$search}%")
                            ->orWhere('name', 'like', "%{$search}%")
                            ->orWhere('description', 'like', "%{$search}%");
                        });
                    }
                })->make(true);
        }
        return view('admin.documents.index', compact('requests', 'customers'));
    }

    public function show(Document $document) {
        $requests = ServiceRequest::all();
        if (($document->request && auth()->user()->can($document->request->service->slug)) || ($document->hasPermission('has_view'))) {
            $users = null;
            if ($document->request && $document->request->customer && $document->request->customer->user) {
                $users = User::where('id', $document->request->customer->user->id)->get();
            }
            return view('admin.documents.show', compact('document', 'users', 'requests'));
        } else {
            abort(403, __('User does not have the right permissions.'));
        }
    }

    public function sendEmail(Request $request, DocumentRepository $documentRepo){
        $result = $documentRepo->sendManyEmail($request);
        if (isset($result['error'])) {
            return response()->json(['error' => $result['error']]);
        }
        return response()->json(['success' => $result['success']]);
    }

    public function deleteMedia($id, DocumentRepository $documentRepo){
        $result = $documentRepo->deleteMedia($id);
        if (isset($result['error'])) {
            return redirect()->back()->with("errors",  $result['error']);
        }
        return redirect()->back()->with('success',$result['success']);
    }

    public function downloadMedia($id) {
        $media = Media::findOrFail($id);
        if ($media) {
            $document = Document::findOrFail($media->model_id);
            $this->users = User::permission($document->request?->service->slug ?? '')->get();
            $this->timelineRepository->newTimeline('download', 'document', $document->id, $document->reference, $this->users);
            return response()->download($media->getPath(), $media->file_name);
        }
        abort(404);
    }

    public function download($id) {
        $document = Document::findOrFail($id);
        if ($document) {
            $mediaItems = $document->getMedia("*");
            if ($mediaItems->count() === 0) {
                abort(404, __('Aucun fichier trouvé pour ce document'));
            }
            if ($mediaItems->count() === 1) {
                $media = $mediaItems->first();
                $this->users = User::permission($document->request?->service->slug ?? '')->get();
                $this->timelineRepository->newTimeline('download', 'document', $document->id, $document->reference, $this->users);
                return response()->download($media->getPath(), $media->file_name);
            }
            $zipFileName = Str::slug($document->name ?? 'document') . '_' . $document->id . '.zip';
            $zipPath = storage_path('app/temp/' . $zipFileName);
            if (!file_exists(dirname($zipPath))) {
                mkdir(dirname($zipPath), 0755, true);
            }
            $zip = new \ZipArchive();
            if ($zip->open($zipPath, \ZipArchive::CREATE) === TRUE) {
                foreach ($mediaItems as $media) {
                    if (file_exists($media->getPath())) {
                        $zip->addFile($media->getPath(), $media->file_name);
                    }
                }
                $zip->close();
                $this->users = User::permission($document->request?->service->slug ?? '')->get();
                $this->timelineRepository->newTimeline('download', 'document', $document->id, $document->reference, $this->users);
                return response()->download($zipPath, $zipFileName)->deleteFileAfterSend(true);
            }
            abort(500, __("Erreur lors de la création de l'archive ZIP"));
        }
        abort(404);
    }

    public function upload(Request $request, DocumentRepository $documentRepo){
        $result = $documentRepo->uploadMedia($request);
        if (isset($result['error'])) {
            return response()->json(['error' => $result['error']]);
        }
        return response()->json(['success' => $result['success'], 'refresh' => true]);
    }

    public function comment(Request $request, DocumentRepository $documentRepo){
        $result = $documentRepo->comment($request);
        if (isset($result['error'])) {
            return response()->json(['error' => $result['error']]);
        }
        return response()->json(['success' => $result['success'], 'refresh' => true]);
    }

    public function deleteComment($id, DocumentRepository $documentRepo){
        $result = $documentRepo->deleteComment($id);
        if (isset($result['error'])) {
            return redirect()->back()->with("errors",  $result['error']);
        }
        return redirect()->back()->with('success',$result['success']);
    }

    public function visibleComment($id, DocumentRepository $documentRepo){
        $result = $documentRepo->visibleComment($id);
        if (isset($result['error'])) {
            return redirect()->back()->with("errors",  $result['error']);
        }
        return redirect()->back()->with('success',$result['success']);
    }

    public function updatePermission(Request $request){
        try {
            DB::beginTransaction();
            $document = Document::findOrFail($request->document_id);
            foreach ($request->permissions as $key => $value) {
                if (auth()->id() != $key) {
                    $user = User::findOrFail($key);
                    if ($document->userPermission($user)) {
                        $document->userPermission($user)->update([
                            'has_view' => $value['has_view']??false,
                            'has_delete' => $value['has_delete']??false,
                            'has_download' => $value['has_download']??false,
                            'has_upload_files' => $value['has_upload_files']??false,
                            'has_send_by_email' => $value['has_send_by_email']??false,
                            'has_comment' => $value['has_comment']??false
                        ]);
                    } else {
                        $document->permissions()->create([
                            'user_id' => $key,
                            'has_view' => $value['has_view']??false,
                            'has_delete' => $value['has_delete']??false,
                            'has_download' => $value['has_download']??false,
                            'has_upload_files' => $value['has_upload_files']??false,
                            'has_send_by_email' => $value['has_send_by_email']??false,
                            'has_comment' => $value['has_comment']??false
                        ]);
                    }
                }
            }
            $this->users = User::permission($document->request?->service->slug ?? '')->get();
            $this->timelineRepository->newTimeline('permission', 'document', $document->id, $document->reference, $this->users);
            DB::commit();
            return response()->json(['success' => __('Action successfully completed.'), 'refresh' => true]);
        } catch (\Exception $e) {
            elog($e);
            DB::rollBack();
            return response()->json(['error' => __('Une erreur est survenue. Veuillez réessayer.')]);
        }
    }

    public function destroy($id, DocumentRepository $documentRepo){
        $result = $documentRepo->delete($id);
        if (isset($result['error'])) {
            return response()->json(['error' => $result['error']]);
        }
        return response()->json(['success' => $result['success']]);
    }

    public function store(Request $request, DocumentRepository $documentRepo){
        $result = $documentRepo->addDocument($request);
        if (isset($result['error'])) {
            return response()->json(['error' => $result['error']]);
        }
        return response()->json(['success' => $result['success'], 'goUrl' => route('admin.documents.show', $result['id'])]);
    }

    public function edit(Document $document){
        if ($document) {
            return response()->json(["success" => true, "document" => $document]);
        } else {
            return response()->json(["success" => false]);
        }
    }

    public function updateDocument(Request $request, DocumentRepository $documentRepo){
        $result = $documentRepo->editDocument($request);
        if (isset($result['error'])) {
            return response()->json(['error' => $result['error']]);
        }
        return response()->json(['success' => $result['success'], 'refresh' => true]);
    }

    public function setMonth(Request $request, DocumentRepository $documentRepo){
        $result = $documentRepo->setmonth($request);
        if (isset($result['error'])) {
            return response()->json(['error' => $result['error']]);
        }
        return response()->json(['success' => $result['success'], 'refresh' => true]);
    }
}