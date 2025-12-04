<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use SoulDoit\SetEnv\Facades\Env;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\DataTables;
use App\Models\Document\DocumentName;
use App\Repositories\TimelineRepository;
use App\Models\User;

class ConfigController extends Controller
{
    protected $timelineRepository;
    protected $users;

    public function __construct(TimelineRepository $timelineRepository){
        $this->timelineRepository = $timelineRepository;
        $this->users = User::permission('configuration')->get();
        $this->middleware('permission:configuration', ['only' => ['getCompany', 'setCompany','getLogo', 'setLogo','getDocs', 'addDocs','editDocs', 'deleteDocs']]);
    }
    
    public function getCompany() {
        return view('admin.config.company');
    }

    public function setCompany(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'app_name' => "required|min:3|max:15",
                'name' => "required",
                'address' => "required",
                'code_postal' => "required",
                'country' => "required",
                'ville' => "required",
                'phone' => "required",
                'email' => "required|email",
                'tax_id' => "required",
                'business_registration_number' => "required"
            ]);
            if ($validator->fails()) {
                return ['error' => $validator->errors()->first()];
            }
            Env::set("APP_NAME", $request->app_name);
            Env::set("COMPANY_NAME", $request->name);
            Env::set("COMPANY_ADDRESS", $request->address);
            Env::set("COMPANY_CODE_POSTAL", $request->code_postal);
            Env::set("COMPANY_COUNTRY", $request->country);
            Env::set("COMPANY_VILLE", $request->ville);
            Env::set("COMPANY_PHONE", $request->phone);
            Env::set("COMPANY_EMAIL", $request->email);
            Env::set("COMPANY_TAX_ID", $request->tax_id);
            Env::set("COMPANY_BUSINESS_REGISTRATION_NUMBER", $request->business_registration_number);
            Artisan::call('config:clear');
            $this->timelineRepository->newTimeline('company', 'configuration', null, null, $this->users, $this->users);
            return response()->json(['success' => __('Action successfully completed.'), 'refresh' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => __('Une erreur est survenue. Veuillez réessayer.')]);
        }
    }

    public function getLogo() {
        return view('admin.config.logo');
    }

    public function setLogo(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'logo' => 'required|image|mimes:jpg,png,jpeg|max:5120'
            ]);
            if ($validator->fails()) {
                return ['error' => $validator->errors()->first()];
            }
            $imageName = time().'.'.$request->logo->getClientOriginalExtension();
            $request->logo->move('storage/logo', $imageName);
            $filepath = 'storage/logo/'.$imageName;
            if (config('company.logo') != "img/logo/logo.png") {
                File::delete(config('company.logo'));
            }
            Env::set("COMPANY_LOGO", $filepath);
            Artisan::call('config:clear');
            $this->timelineRepository->newTimeline('logo', 'configuration', null, null, $this->users);
            return response()->json(['success' => __('Action successfully completed.'), 'refresh' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => __('Une erreur est survenue. Veuillez réessayer.')]);
        }
    }

    public function getDocs(Request $request) {
        if(request()->ajax()) {
            return DataTables::of(DocumentName::query()->orderBy('id', 'desc'))
                ->addColumn('action', function ($data) {
                    return view('admin.config.partials.action', [ 'data' => $data ]);
                })->filter(function ($query) use ($request) {
                    if ($request->has('search') && !empty($request->search['value'])) {
                        $search = $request->search['value'];
                        $query->where(function ($q) use ($search) {
                            $q->where('name', 'like', "%{$search}%");
                        });
                    }
                })->make(true);
        }
        return view('admin.config.docs');
    }

    public function addDocs(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|unique:document_names,name',
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->first()]);
            }
            DB::beginTransaction();
            DocumentName::create(['name' => $request->name]);
            $this->timelineRepository->newTimeline('documents', 'configuration', null, null, $this->users);
            DB::commit();
            return response()->json(['success' => __('Action successfully completed.')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => __('Une erreur est survenue. Veuillez réessayer.')]);
        }
    }

    public function editDocs(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required|exists:document_names,id',
                'name' => 'required|string|unique:document_names,name,'.$request->id,
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->first()]);
            }
            DB::beginTransaction();
            $d = DocumentName::findOrFail($request->id);
            $d->update(['name' => $request->name]);
            $this->timelineRepository->newTimeline('documents', 'configuration', null, null, $this->users);
            DB::commit();
            return response()->json(['success' => __('Action successfully completed.')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => __('Une erreur est survenue. Veuillez réessayer.')]);
        }
    }

    public function deleteDocs($id) {
        try {
            DB::beginTransaction();
            DocumentName::findOrFail($id)->delete();
            $this->timelineRepository->newTimeline('documents', 'configuration', null, null, $this->users);
            DB::commit();
            return response()->json(['success' => __('Action successfully completed.')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => __('Une erreur est survenue. Veuillez réessayer.')]);
        }
    }
}