<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use App\Repositories\CustomerRepository;
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
use App\Mail\CustomerMail;
use App\Repositories\TimelineRepository;

class CustomerController extends Controller
{
    protected $timelineRepository;
    protected $users;

    public function __construct(TimelineRepository $timelineRepository){
        $this->timelineRepository = $timelineRepository;
        $this->users = User::permission('customers')->get();
        $this->middleware('permission:customers', ['only' => ['index','create','store','show','edit','update','destroy','downloadPDF','activationAccount','deleteAccount','addAccount', 'sendEmail']]);
    }
    
    public function index(Request $request) {
        if(request()->ajax()) {
            $query = Customer::query()->with(['user'])->withCount('demandes');
            $orderColumn = $request->input('order.0.column');
            $orderDirection = $request->input('order.0.dir');
            $columns = [
                'id',
                'last_name',
                'customer_type',
                'email',
                'id_number',
                'has_account',
                'created_at',
                'demandes_count',
            ];
            if ($request->has('customer_type') && !empty($request->customer_type)) {
                $query->where('customer_type', $request->customer_type);
            }
            if ($request->has('id_type') && !empty($request->id_type)) {
                $query->where('id_type', $request->id_type);
            }
            if ($request->has('has_account') && !empty($request->has_account)) {
                if ($request->has_account == "yes") {
                    $query->whereHas('user');
                } else if ($request->has_account == "no"){
                    $query->whereDoesntHave('user');
                }
            }
            if ($orderColumn !== null && isset($columns[$orderColumn])) {
                $query->orderBy($columns[$orderColumn], $orderDirection);
            } else {
                $query->orderBy('id', 'desc');
            }
            return DataTables::of($query)
                ->addColumn('has_account', function ($data) {
                    return view('admin.customers.partials.account', [ 'data' => $data ]);
                })->addColumn('id_number', function ($data) {
                    return view('admin.customers.partials.identity', [ 'data' => $data ]);
                })->addColumn('action', function ($data) {
                    return view('admin.customers.partials.action', [ 'data' => $data ]);
                })->addColumn('name', function ($data) {
                    return view('admin.customers.partials.name', [ 'data' => $data ]);
                })->addColumn('customer_type', function ($data) {
                    return view('admin.customers.partials.type', [ 'data' => $data ]);
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
                            ->orWhere('customer_type', 'like', "%{$search}%");
                        });
                    }
                })->make(true);
        }
        return view('admin.customers.index');
    }

    public function create(){
        return view('admin.customers.form');
    }

    public function store(Request $request, CustomerRepository $customerRepo){
        $result = $customerRepo->addCustomer($request);
        if (isset($result['error'])) {
            return response()->json(['error' => $result['error']]);
        }
        return response()->json(['success' => $result['success'], 'goUrl' => route('admin.customers.show', $result['id'])]);
    }

    public function show(Customer $customer){
        if ($customer) {
            return view('admin.customers.show', compact('customer'));
        } else {
            abort(404);
        }
    }

    public function edit(Customer $customer){
        if ($customer) {
            return view('admin.customers.form', compact('customer'));
        } else {
            abort(404);
        }
    }

    public function update(Request $request, Customer $customer, CustomerRepository $customerRepo){
        $result = $customerRepo->editCustomer($request, $customer);
        if (isset($result['error'])) {
            return response()->json(['error' => $result['error']]);
        }
        return response()->json(['success' => $result['success'], 'goUrl' => route('admin.customers.show', $result['id'])]);
    }

    public function destroy($id, CustomerRepository $customerRepo){
        $result = $customerRepo->deleteCustomer($id);
        if (isset($result['error'])) {
            return response()->json(['error' => $result['error']]);
        }
        return response()->json(['success' => $result['success']]);
    }

    public function downloadPDF($id){
        $customer = Customer::findOrFail($id);
        if ($customer) {
            $pdf = PDF::loadView('admin.customers.fiche-pdf', ['customer' => $customer])
                ->setOption('enable-local-file-access', true)
                ->setOption('images', true)
                ->setOption('encoding', 'UTF-8')
                ->setOption('margin-top', '5mm')  // Réduit les marges
                ->setOption('margin-bottom', '7mm')
                ->setOption('margin-left', '5mm')
                ->setOption('margin-right', '5mm')
                ->setOption('disable-smart-shrinking', false)  // Important !
                ->setOption('background', true)  // Active les backgrounds
                ->setOption('no-background', false)  // Désactive l'option "no-background"
                ->setOption('print-media-type', true);  // Utilise les styles d'impression
            return $pdf->stream('customer-' . $customer->reference . '.pdf');
        } else {
            abort(404);
        }
    }

    public function activationAccount($id){
        try {
            $customer = Customer::findOrFail($id);
            if ($customer) {
                if (!$customer->user) {
                    return response()->json(['error' => __("Client n'a pas de compte.")]);
                }
                $customer->activation(!$customer->user->is_active);
                $this->timelineRepository->newTimeline($customer->user->is_active ? 'active' : 'inactive', 'customer', $customer->id, $customer->reference, $this->users);
            } else {
                return response()->json(['error' => __('Une erreur est survenue. Veuillez réessayer.')]);
            }
            return response()->json(['success' => __('Action successfully completed.')]);
        } catch (\Exception $e) {
            return response()->json(['error' => __('Une erreur est survenue. Veuillez réessayer.')]);
        }
    }

    public function deleteAccount($id){
        try {
            DB::beginTransaction();
            $user = User::findOrFail($id);
            $customer = $user->customer;
            $user->delete();
            $this->timelineRepository->newTimeline('delete_account', 'customer', $customer->id, $this->users);
            DB::commit();
            return response()->json(['success' => __('Action successfully completed.')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => __('Une erreur est survenue. Veuillez réessayer.')]);
        }
    }

    public function addAccount(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'customer_id' => 'required|exists:customers,id',
                'password' => ['required', PasswordRule::min(8)->mixedCase()->letters()->numbers()],
                'password_confirmation' => ['required','same:password'],
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->first()]);
            }
            DB::beginTransaction();
            $customer = Customer::findOrFail($request->customer_id);
            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
            $input['email'] = $customer->email;
            $input['name'] = $customer->last_name.' '.$customer->first_name;
            $user = User::create($input);
            $user->sendEmailVerificationNotification();
            if (isset($request->user_send_email)) {
                $this->sendUserEmail($user, $request->password);
            }
            $this->timelineRepository->newTimeline('create_account', 'customer', $customer->id, $customer->reference, $this->users);
            DB::commit();
            return response()->json(['success' => __('Action successfully completed.')]);
        } catch (\Exception $e) {
            elog($e);
            DB::rollBack();
            return response()->json(['error' => __('Une erreur est survenue. Veuillez réessayer.')]);
        }
    }

    public function sendEmail(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required|exists:customers,id',
                'emailfrom' => 'required|email',
                'emailTo' => 'required|email',
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
                return response()->json(['error' => $validator->errors()->first()]);
            }
            $customer = Customer::findOrFail($request->id);
            $attachments = [];
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
            $mail = new CustomerMail($request->emailSubject, $request->message, $attachments);
            Mail::to($request->emailTo)->send($mail);
            $this->timelineRepository->newTimeline('email', 'customer', $customer->id, $customer->reference, $this->users);
            return response()->json(['success' => __('Action successfully completed.')]);
        } catch (\Exception $e) {
            elog($e);
            return response()->json(['error' =>  __('Une erreur est survenue. Veuillez réessayer.')]);
        }
    }

    protected function sendUserEmail($user, $plainPassword){
        Mail::to($user->email)->queue(new UserParameter($user, $plainPassword));
    }

}