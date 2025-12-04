<?php
    
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Permission\Role;
use App\Models\Permission\Permission;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Repositories\TimelineRepository;

class RoleController extends Controller
{
    protected $timelineRepository;
    protected $users;

    public function __construct(TimelineRepository $timelineRepository){
        $this->timelineRepository = $timelineRepository;
        $this->users = User::permission('users')->get();
        $this->middleware('permission:users', ['only' => ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']]);
    }
    
    public function index(Request $request) {
        if(request()->ajax()) {
            return DataTables::of(Role::query()->with('permissions')->orderBy('id', 'desc'))
                ->addColumn('action', function ($data) {
                    return view('admin.roles.partials.action', [ 'data' => $data ]);
                })->addColumn('permissions', function ($data) {
                    return view('admin.roles.partials.permissions', [ 'data' => $data ]);
                })->addColumn('service-permissions', function ($data) {
                    return view('admin.roles.partials.service-permissions', [ 'data' => $data ]);
                })->make(true);
        }
        return view('admin.roles.index');
    }

    public function create(){
        $permission = Permission::whereNull('service_id')->get();
        $permissionService = Permission::whereNotNull('service_id')->get();
        return view('admin.roles.form',compact('permission', 'permissionService'));
    }
    
    public function store(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:roles,name',
                'permission' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->first()]);
            }
            DB::beginTransaction();
            $role = Role::create(['name' => $request->input('name')]);
            $role->syncPermissions($request->input('permission'));
            $this->timelineRepository->newTimeline('create', 'role', $role->id, $role->name, $this->users);
            DB::commit();
            return response()->json(['success' => __('Action successfully completed.'), 'goUrl' => route('admin.roles.index')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => __('Une erreur est survenue. Veuillez réessayer.')]);
        }
    }
    
    public function edit($id){
        $role = Role::find($id);
        if ($role && ($role->id != 1)) {
            $permission = Permission::whereNull('service_id')->get();
            $permissionService = Permission::whereNotNull('service_id')->get();
            $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')->all();
            return view('admin.roles.form',compact('role','permission', 'permissionService','rolePermissions'));
        } else {
            abort(404);
        }
    }
    
    public function update(Request $request, $id){
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:roles,name,'.$id,
                'permission' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->first()]);
            }
            DB::beginTransaction();
            $role = Role::find($id);
            if ($role->id != 1) {
                $role->name = $request->input('name');
                $role->save();
                $role->syncPermissions($request->input('permission'));
            }
            DB::commit();
            $this->timelineRepository->newTimeline('edit', 'role', $role->id, $role->name, $this->users);
            return response()->json(['success' => __('Action successfully completed.'), 'goUrl' => route('admin.roles.index')]);
        } catch (\Exception $e) {
            elog($e);
            DB::rollBack();
            return response()->json(['error' => __('Une erreur est survenue. Veuillez réessayer.')]);
        }
    }
    
    public function destroy($id){
        try {
            if (!DB::table('model_has_roles')->where('role_id', $id)->exists() && ($id != 1)) {
                DB::beginTransaction();
                $role = Role::findOrFail($id);
                $i = $role->id;
                $n = $role->name;
                $role->delete();
                $this->timelineRepository->newTimeline('delete', 'role', $i, $n, $this->users);
                DB::commit();
                return response()->json(['success' => __('Action successfully completed.')]);
            }else{
                return response()->json(['success' => __('Ce role a des utilisateur. Vous ne pouvez pas le supprimer définitivement.')]);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => __('Une erreur est survenue. Veuillez réessayer.')]);
        }
    }
}