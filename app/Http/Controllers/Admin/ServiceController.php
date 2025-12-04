<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use App\Repositories\ServiceRepository;
use App\Repositories\TimelineRepository;
use App\Models\User;

class ServiceController extends Controller
{
    protected $timelineRepository;
    protected $users;

    public function __construct(TimelineRepository $timelineRepository){
        $this->timelineRepository = $timelineRepository;
        $this->users = User::permission('services')->get();
        $this->middleware('permission:services', ['only' => ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy', 'activation']]);
    }
    
    public function index(Request $request) {
        if(request()->ajax()) {
            $query = Service::query()->withCount('demandes');
            $orderColumn = $request->input('order.0.column');
            $orderDirection = $request->input('order.0.dir');
            $columns = [
                'id',
                'name',
                'active',
                'demandes_count',
                'created_at',
            ];
            if ($orderColumn !== null && isset($columns[$orderColumn])) {
                $query->orderBy($columns[$orderColumn], $orderDirection);
            } else {
                $query->orderBy('id', 'desc');
            }
            return DataTables::of($query)
                ->addColumn('action', function ($data) {
                    return view('admin.services.partials.action', [ 'data' => $data ]);
                })->addColumn('status', function ($data) {
                    return view('admin.services.partials.status', [ 'data' => $data ]);
                })->filter(function ($query) use ($request) {
                    if ($request->has('search') && !empty($request->search['value'])) {
                        $search = $request->search['value'];
                        $query->where(function ($q) use ($search) {
                            $q->where('id', 'like', "%{$search}%")
                            ->orWhere('name', 'like', "%{$search}%");
                        });
                    }
                })->make(true);
        }
        return view('admin.services.index');
    }

    public function create(){
        return view('admin.services.form');
    }

    public function store(Request $request, ServiceRepository $serviceRepo){
        $result = $serviceRepo->addService($request);
        if (isset($result['error'])) {
            return response()->json(['error' => $result['error']]);
        }
        return response()->json(['success' => $result['success'], 'goUrl' => route('admin.services.show', $result['id'])]);
    }

    public function show(Service $service){
        if ($service) {
            return view('admin.services.show', compact('service'));
        } else {
            abort(404);
        }
    }

    public function edit(Service $service){
        if ($service) {
            return view('admin.services.form', compact('service'));
        } else {
            abort(404);
        }
    }

    public function update(Request $request, Service $service, ServiceRepository $serviceRepo){
        $result = $serviceRepo->editService($request, $service);
        if (isset($result['error'])) {
            return response()->json(['error' => $result['error']]);
        }
        return response()->json(['success' => $result['success'], 'goUrl' => route('admin.services.show', $result['id'])]);
    }

    public function destroy(Service $service, ServiceRepository $serviceRepo){
        $result = $serviceRepo->deleteService($service);
        if (isset($result['error'])) {
            return response()->json(['error' => $result['error']]);
        }
        return response()->json(['success' => $result['success']]);
    }

    public function activation($id){
        try {
            $service = Service::findOrFail($id);
            $service->activation(!$service->active);
            $this->timelineRepository->newTimeline($service->active ? 'active' : 'inactive', 'service', $service->id, $service->reference, $this->users);
            return response()->json(['success' => __('Action successfully completed.')]);
        } catch (\Exception $e) {
            return response()->json(['error' => __('Une erreur est survenue. Veuillez réessayer.')]);
        }
    }
}