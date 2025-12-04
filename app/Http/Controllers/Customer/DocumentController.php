<?php

namespace App\Http\Controllers\Customer;

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

class DocumentController extends Controller
{
    public function index(Request $request){
        $user = auth()->user();
        $customer = getCustomer();
        $requests = ServiceRequest::where('customer_id', $customer->id)->get();
        if(request()->ajax()) {
            $query = Document::query()->with(['request', 'request.customer', 'request.service', 'permissions'])
                ->whereHas('request.customer', function($q) use ($customer) {
                    $q->where('id', $customer->id);
                })->whereHas('permissions', function($q) use ($user) {
                    $q->where('user_id', $user->id)->where('has_view', true);
                });
            $orderColumn = $request->input('order.0.column');
            $orderDirection = $request->input('order.0.dir');
            $columns = [
                'id',
                'request_id',
                'name',
                'month',
                'created_at',
                'action',
            ];
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
                    return view('customer.documents.partials.request', [ 'data' => $data ]);
                })->addColumn('name', function ($data) {
                    return view('customer.documents.partials.name', [ 'data' => $data ]);
                })->addColumn('month', function ($data) {
                    return view('customer.documents.partials.month', [ 'data' => $data ]);
                })->addColumn('action', function ($data) {
                    return view('customer.documents.partials.action', [ 'data' => $data ]);
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
        return view('customer.documents.index', compact('requests'));
    }

    public function destroy($id, DocumentRepository $documentRepo){
        $document = Document::findOrFail($id);
        if ($document->hasPermission('has_delete')) {
            $result = $documentRepo->delete($id);
            if (isset($result['error'])) {
                return response()->json(['error' => $result['error']]);
            }
            return response()->json(['success' => $result['success']]);
        }
        return response()->json(['error' => 'Unauthorized']);
    }

    public function download($id) {
        $document = Document::findOrFail($id);
        if ($document->hasPermission('has_download')) {
            if ($document) {
                $mediaItems = $document->getMedia("*");
                if ($mediaItems->count() === 0) {
                    abort(404, __('Aucun fichier trouvé pour ce document'));
                }
                if ($mediaItems->count() === 1) {
                    $media = $mediaItems->first();
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
                    return response()->download($zipPath, $zipFileName)->deleteFileAfterSend(true);
                }
                abort(500, __("Erreur lors de la création de l'archive ZIP"));
            }
            abort(404);
        }
        abort(401);
    }

    public function show(Document $document) {
        if ($document->hasPermission('has_view')){
            $requests = ServiceRequest::where('customer_id', $customer->id)->get();
            return view('customer.documents.show', compact('document', 'requests'));
        }
        abort(401);
    }

    //*********************** */
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
            return response()->download($media->getPath(), $media->file_name);
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

}
