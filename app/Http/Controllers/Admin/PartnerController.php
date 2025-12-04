<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner\Partner;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use App\Repositories\PartnerRepository;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use App\Models\Request\Request as ServiceRequest;
use App\Models\Document\Document;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Mail;
use App\Mail\UserParameter;
use Illuminate\Validation\Rules\Password as PasswordRule;
use App\Mail\PartnerMail;
use App\Repositories\TimelineRepository;

class PartnerController extends Controller
{
    protected $timelineRepository;

    public function __construct(TimelineRepository $timelineRepository){
        $this->timelineRepository = $timelineRepository;
        $this->middleware('permission:partners', ['only' => ['index','create','store','show','edit','update','destroy']]);
    }

    public function index(Request $request) {
        if(request()->ajax()) {
            $query = Partner::query();
            $orderColumn = $request->input('order.0.column');
            $orderDirection = $request->input('order.0.dir');
            $columns = [
                'id',
                'last_name',
                'partner_type',
                'email',
                'id_number',
                'created_at',
            ];
            if ($request->has('partner_type') && !empty($request->partner_type)) {
                $query->where('partner_type', $request->partner_type);
            }
            if ($request->has('id_type') && !empty($request->id_type)) {
                $query->where('id_type', $request->id_type);
            }
            if ($orderColumn !== null && isset($columns[$orderColumn])) {
                $query->orderBy($columns[$orderColumn], $orderDirection);
            } else {
                $query->orderBy('id', 'desc');
            }
            return DataTables::of($query)
                ->addColumn('id_number', function ($data) {
                    return view('admin.partners.partials.identity', [ 'data' => $data ]);
                })->addColumn('action', function ($data) {
                    return view('admin.partners.partials.action', [ 'data' => $data ]);
                })->addColumn('name', function ($data) {
                    return view('admin.partners.partials.name', [ 'data' => $data ]);
                })->addColumn('partner_type', function ($data) {
                    return view('admin.partners.partials.type', [ 'data' => $data ]);
                })->filter(function ($query) use ($request) {
                    if ($request->has('search') && !empty($request->search['value'])) {
                        $search = $request->search['value'];
                        $query->where(function ($q) use ($search) {
                            $q->where('id', 'like', "%{$search}%")
                            ->orWhere('reference', 'like', "%{$search}%")
                            ->orWhere('id_number', 'like', "%{$search}%")
                            ->orWhere(DB::raw("CONCAT(first_name, ' ', last_name)"), 'LIKE', "%{$search}%")
                            ->orWhere(DB::raw("CONCAT(last_name, ' ', first_name)"), 'LIKE', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%")
                            ->orWhere('partner_type', 'like', "%{$search}%");
                        });
                    }
                })->make(true);
        }
        return view('admin.partners.index');
    }

    public function create(){
        return view('admin.partners.form');
    }

    public function store(Request $request, PartnerRepository $partnerRepo){
        $result = $partnerRepo->addPartner($request);
        if (isset($result['error'])) {
            return response()->json(['error' => $result['error']]);
        }
        return response()->json(['success' => $result['success'], 'goUrl' => route('admin.partners.show', $result['id'])]);
    }

    public function show(Partner $partner){
        if ($partner) {
            return view('admin.partners.show', compact('partner'));
        } else {
            abort(404);
        }
    }

    public function edit(Partner $partner){
        if ($partner) {
            return view('admin.partners.form', compact('partner'));
        } else {
            abort(404);
        }
    }

    public function update(Request $request, Partner $partner, PartnerRepository $partnerRepo){
        $result = $partnerRepo->editPartner($request, $partner);
        if (isset($result['error'])) {
            return response()->json(['error' => $result['error']]);
        }
        return response()->json(['success' => $result['success'], 'goUrl' => route('admin.partners.show', $result['id'])]);
    }

    public function destroy($id, PartnerRepository $partnerRepo){
        $result = $partnerRepo->deletePartner($id);
        if (isset($result['error'])) {
            return response()->json(['error' => $result['error']]);
        }
        return response()->json(['success' => $result['success']]);
    }

}