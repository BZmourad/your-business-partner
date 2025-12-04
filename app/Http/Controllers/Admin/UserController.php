<?php
    
namespace App\Http\Controllers\Admin;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Permission\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Repositories\TimelineRepository;
use Mail;
use App\Mail\UserParameter;

class UserController extends Controller
{
    protected $timelineRepository;
    protected $users;

    public function __construct(TimelineRepository $timelineRepository){
        $this->timelineRepository = $timelineRepository;
        $this->users = User::permission('users')->get();
        $this->middleware('permission:users', ['only' => ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']]);
    }
    
    public function index(Request $request){
        if(request()->ajax()) {
            return DataTables::of(User::query()->where('type', 'admin')->orderBy('id', 'desc'))
                ->addColumn('action', function ($data) {
                    return view('admin.users.partials.action', [ 'data' => $data ]);
                })->addColumn('name', function ($data) {
                    return view('admin.users.partials.name', [ 'data' => $data ]);
                })->addColumn('role', function ($data) {
                    return view('admin.users.partials.role', [ 'data' => $data ]);
                })->addColumn('status', function ($data) {
                    return view('admin.users.partials.status', [ 'data' => $data ]);
                })->make(true);
        }
        return view('admin.users.index');
    }
    
    public function create(){
        $roles = Role::pluck('name','name')->all();
        return view('admin.users.form',compact('roles'));
    }
    
    public function store(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'role' => 'required',
                'avatar' => 'nullable|image|mimes:jpg,png,jpeg|max:5120',
                'password' => ['required','min:8','alpha_num'],
                'password_confirmation' => ['required','same:password'],
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->first()]);
            }
            DB::beginTransaction();
            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
            $user = User::create($input);
            if ($request->hasFile('avatar')) {
                $user->addDocument($request->avatar);
            }
            $user->assignRole([$request->input('role')]);
            $user->sendEmailVerificationNotification();
            if (isset($request->user_send_email)) {
                $this->sendUserEmail($user, $request->password);
            }
            $this->timelineRepository->newTimeline('create', 'user', $user->id, $user->name, $this->users);
            DB::commit();
            return response()->json(['success' => __('Action successfully completed.'), 'goUrl' => route('admin.users.show', $user->id)]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => __('Une erreur est survenue. Veuillez réessayer.')]);
        }
    }
    
    public function show($id){
        $user = User::find($id);
        if ($user && $user->id != 1 && $user->id != auth()->id()) {
            return view('admin.users.show',compact('user'));
        } else {
            abort(404);
        }
    }
    
    public function edit($id){
        $user = User::find($id);
        if ($user && $user->id != 1 && $user->id != auth()->id()) {
            $roles = Role::pluck('name','name')->all();
            $userRole = $user->getRoleNames()[0];
            return view('admin.users.form',compact('user','roles','userRole'));
        } else {
            abort(404);
        }
    }
    
    public function update(Request $request, $id){
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,'.$id,
                'role' => 'required',
                'avatar' => 'nullable|image|mimes:jpg,png,jpeg|max:5120',
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->first()]);
            }
            DB::beginTransaction();
            $user = User::find($id);
            $email = $user->email;
            $input = $request->all();
            $user->update($input);
            if ($request->hasFile('avatar')) {
                $user->addDocument($request->avatar);
            }
            $user->assignRole([$request->input('role')]);
            if($request->email != $email){
                $user->email_verified_at = null;
                $user->sendEmailVerificationNotification();
            }
            $this->timelineRepository->newTimeline('edit', 'user', $user->id, $user->name, $this->users);
            DB::commit();
            return response()->json(['success' => __('Action successfully completed.'), 'goUrl' => route('admin.users.show', $user->id)]);
        } catch (\Exception $e) {
            elog($e);
            DB::rollBack();
            return response()->json(['error' => __('Une erreur est survenue. Veuillez réessayer.')]);
        }
    }
    
    public function destroy($id){
        try {
            if ($id != 1) {
                DB::beginTransaction();
                $user = User::find($id);
                $i = $user->id;
                $n = $user->name;
                $user->delete();
                $this->timelineRepository->newTimeline('delete', 'user', $i, $n, $this->users);
                DB::commit();
            }
            return response()->json(['success' => __('Action successfully completed.')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => __('Une erreur est survenue. Veuillez réessayer.')]);
        }
    }

    public function activation($id){
        try {
            $user = User::findOrFail($id);
            $user->update([ 'is_active' => !$user->is_active]);
            $this->timelineRepository->newTimeline($user->is_active ? 'active' : 'inactive', 'user', $user->id, $user->name, $this->users);
            return response()->json(['success' => __('Action successfully completed.')]);
        } catch (\Exception $e) {
            return response()->json(['error' => __('Une erreur est survenue. Veuillez réessayer.')]);
        }
    }

    protected function sendUserEmail($user, $plainPassword){
        Mail::to($user->email)->queue(new UserParameter($user, $plainPassword));
    }
}