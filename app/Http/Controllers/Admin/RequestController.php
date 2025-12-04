<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service\Service;
use App\Models\Customer\Customer;
use App\Models\Request\Request as ServiceRequest;
use Illuminate\Support\Facades\DB;
use App\Repositories\RequestRepository;
use App\Repositories\DocumentRepository;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use App\Models\Document\Document;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Repositories\TimelineRepository;

class RequestController extends Controller
{
    protected $timelineRepository;

    public function __construct(TimelineRepository $timelineRepository){
        $this->timelineRepository = $timelineRepository;
    }
    
    public function index(Request $request) {
        $customers = Customer::all();
        $services = Service::get();
        if(request()->ajax()) {
            $allowedServices = $services->filter(function ($service) {
                return auth()->user()->can($service->slug);
            });
            $query = ServiceRequest::query()->with(['service', 'customer'])->whereIn('service_id', $allowedServices->pluck('id'));
            $orderColumn = $request->input('order.0.column');
            $orderDirection = $request->input('order.0.dir');
            $columns = [
                'id',
                'service.name',
                'customer.last_name',
                'status',
                'paid_status',
                'created_at',
            ];
            if ($orderColumn !== null && isset($columns[$orderColumn])) {
                $query->orderBy($columns[$orderColumn], $orderDirection);
            } else {
                $query->orderBy('id', 'desc');
            }
            if ($request->has('status') && !empty($request->status)) {
                $query->where('status', $request->status);
            }
            if ($request->has('paid_status') && !empty($request->paid_status)) {
                $query->where('paid_status', $request->paid_status);
            }
            if ($request->has('service') && !empty($request->service)) {
                $query->where('service_id', $request->service);
            }
            if ($request->has('customer') && !empty($request->customer)) {
                $query->where('customer_id', $request->customer);
            }
            return DataTables::of($query)
                ->addColumn('service', function ($data) {
                    return view('admin.requests.partials.service', [ 'data' => $data ]);
                })->addColumn('customer', function ($data) {
                    return $data->customer->reference.'| '.$data->customer->last_name.' '.$data->customer->first_name;
                })->addColumn('action', function ($data) {
                    return view('admin.requests.partials.action', [ 'data' => $data ]);
                })->addColumn('status', function ($data) {
                    return view('admin.requests.partials.status', [ 'data' => $data ]);
                })->addColumn('paid_status', function ($data) {
                    return view('admin.requests.partials.paid_status', [ 'data' => $data ]);
                })->filter(function ($query) use ($request) {
                    if ($request->has('search') && !empty($request->search['value'])) {
                        $search = $request->search['value'];
                        $query->where(function ($q) use ($search) {
                            $q->where('id', 'like', "%{$search}%")
                            ->orWhere('service.name', 'like', "%{$search}%")
                            ->orWhere('customer.last_name', 'like', "%{$search}%")
                            ->orWhere('status', 'like', "%{$search}%")
                            ->orWhere('paid_status', 'like', "%{$search}%");
                        });
                    }
                })->make(true);
        }
        return view('admin.requests.index', compact('customers', 'services'));
    }

    public function chooseService(){
        $services = Service::where('active', true)->get()->filter(function ($service) {
            return auth()->user()->can($service->slug);
        });;
        return view('admin.requests.services', compact('services'));
    }

    public function add($id){
        $service = Service::findOrFail($id);
        if ($service && auth()->user()->can($service->slug) && $service->active) {
            $customers = Customer::all();
            return view('admin.requests.create', compact('service', 'customers'));
        } else {
            abort(403, __('User does not have the right permissions.'));
        }
    }

    public function store(Request $request, RequestRepository $requestRepo){
        $result = $requestRepo->addServiceRequest($request);
        if (isset($result['error'])) {
            return response()->json(['error' => $result['error']]);
        }
        return response()->json(['success' => $result['success'], 'goUrl' => route('admin.requests.show', $result['id'])]);
    }

    public function show(ServiceRequest $request){
        $service = Service::findOrFail($request->service_id);
        if ($request && auth()->user()->can($service->slug)) {
            $mode = 1;
            return view('admin.requests.show', compact('request', 'mode'));
        } else {
            abort(404);
        }
    }

    public function edit(ServiceRequest $request){
        $service = Service::findOrFail($request->service_id);
        if ($request && auth()->user()->can($service->slug)) {
            $customers = Customer::all();
            return view('admin.requests.edit', compact('service', 'request', 'customers'));
        } else {
            abort(404);
        }
    }

    public function destroy(ServiceRequest $request, RequestRepository $requestRepo){
        $result = $requestRepo->deleteServiceRequest($request);
        if (isset($result['error'])) {
            return response()->json(['error' => $result['error']]);
        }
        return response()->json(['success' => $result['success']]);
    }

    public function getDocuments($id, Request $request) {
        if(request()->ajax()) {
            $query = Document::query()->where('request_id', $id);
            $orderColumn = $request->input('order.0.column');
            $orderDirection = $request->input('order.0.dir');
            $columns = [
                'id',
                'name',
                'month',
                'created_at',
                'action',
            ];
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
                ->addColumn('name', function ($data) {
                    return view('admin.requests.partials.documents.name', [ 'data' => $data ]);
                })->addColumn('month', function ($data) {
                    return view('admin.requests.partials.documents.month', [ 'data' => $data ]);
                })->addColumn('action', function ($data) {
                    return view('admin.requests.partials.documents.action', [ 'data' => $data ]);
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
    }

    public function setStatus(Request $request, RequestRepository $requestRepo){
        $result = $requestRepo->setStatusRequest($request);
        if (isset($result['error'])) {
            return redirect()->back()->with("errors",  $result['error']);
        }
        return redirect()->back()->with('success',$result['success']);
    }

    public function setStatusJSON(Request $request, RequestRepository $requestRepo){
        $result = $requestRepo->setStatusRequest($request);
        if (isset($result['error'])) {
            return response()->json(['error' => $result['error']]);
        }
        return response()->json(['success' => $result['success']]);
    }

    public function setPaidStatus(Request $request, RequestRepository $requestRepo){
        $result = $requestRepo->setPaidStatusRequest($request);
        if (isset($result['error'])) {
            return redirect()->back()->with("errors",  $result['error']);
        }
        return redirect()->back()->with('success',$result['success']);
    }

    public function setPaidStatusJSON(Request $request, RequestRepository $requestRepo){
        $result = $requestRepo->setPaidStatusRequest($request);
        if (isset($result['error'])) {
            return response()->json(['error' => $result['error']]);
        }
        return response()->json(['success' => $result['success']]);
    }

    public function updateForm(Request $request, RequestRepository $requestRepo){
        $result = $requestRepo->updateForm($request);
        if (isset($result['error'])) {
            return redirect()->back()->with("errors",  $result['error']);
        }
        return redirect()->back()->with('success',$result['success']);
    }

    public function comment(Request $request, RequestRepository $requestRepo){
        $result = $requestRepo->comment($request);
        if (isset($result['error'])) {
            return response()->json(['error' => $result['error']]);
        }
        return response()->json(['success' => $result['success'], 'refresh' => true]);
    }

    public function deleteComment($id, RequestRepository $requestRepo){
        $result = $requestRepo->deleteComment($id);
        if (isset($result['error'])) {
            return redirect()->back()->with("errors",  $result['error']);
        }
        return redirect()->back()->with('success',$result['success']);
    }

    public function visibleComment($id, RequestRepository $requestRepo){
        $result = $requestRepo->visibleComment($id);
        if (isset($result['error'])) {
            return redirect()->back()->with("errors",  $result['error']);
        }
        return redirect()->back()->with('success',$result['success']);
    }

}