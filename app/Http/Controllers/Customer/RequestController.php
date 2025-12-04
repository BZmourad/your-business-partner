<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service\Service;
use App\Models\Customer\Customer;
use App\Models\Request\Request as ServiceRequest;
use Illuminate\Support\Facades\DB;
use App\Repositories\RequestRepository;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class RequestController extends Controller
{
    public function chooseService(){
        $services = Service::where('active', true)->get();
        return view('customer.requests.services', compact('services'));
    }

    public function add($id){
        $service = Service::findOrFail($id);
        if ($service) {
            $customers = Customer::all();
            return view('customer.requests.create', compact('service', 'customers'));
        } else {
            abort(404);
        }
    }

    public function store(Request $request, RequestRepository $requestRepo){
        $result = $requestRepo->addServiceRequest($request);
        if (isset($result['error'])) {
            return response()->json(['error' => $result['error']]);
        }
        return response()->json(['success' => $result['success'], 'goUrl' => route('customer.requests.show', $result['id'])]);
    }

}