<?php
namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Service\Service;
use App\Models\Service\ServiceFormField;
use App\Models\Service\ServiceDocument;
use App\Models\Permission\Permission;
use App\Models\Permission\Role;
use App\Repositories\TimelineRepository;
use App\Models\User;

class ServiceRepository
{
    protected $timelineRepository;
    protected $users;

    public function __construct(TimelineRepository $timelineRepository){
        $this->timelineRepository = $timelineRepository;
        $this->users = User::permission('services')->get();
    }

    public function addService(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|unique:services,name',
                'description' => 'nullable|string',
                'documents' => 'nullable|array',
                'documents.*.name' => 'required|string|max:255',
                'documents.*.description' => 'nullable|string',
                'fields' => 'nullable|array',
                'fields.*.name' => 'required|string|max:255',
                'fields.*.description' => 'nullable|string',
                'fields.*.type' => 'required|in:short_text,long_text,number,date,datetime,single_select,multiple_select',
                'fields.*.options' => 'nullable',
            ]);
            if ($validator->fails()) {
                return ['error' => $validator->errors()->first()];
            }
            DB::beginTransaction();
            $service = Service::create([
                'name' => $request->name,
                'slug' => createUniqueSlug($request->name, Service::class),
                'description' => $request->description,
            ]);
            $service->update(['reference'=>getRefrence($service->id, "SV")]);
            $permission = Permission::create(['name' => $service->slug, 'service_id' => $service->id, 'description' => $service->name]);
            $role = Role::find(1)->givePermissionTo($permission);
            if ($request->has('documents')) {
                foreach ($request->documents as $documentData) {
                    ServiceDocument::create([
                        'service_id' => $service->id,
                        'name' => $documentData['name'],
                        'description' => $documentData['description'] ?? null,
                        'is_required' => isset($documentData['is_required']) ? true : false,
                    ]);
                }
            }
            if ($request->has('fields')) {
                foreach ($request->fields as $fieldData) {
                    ServiceFormField::create([
                        'service_id' => $service->id,
                        'name' => $fieldData['name'],
                        'description' => $fieldData['description'] ?? null,
                        'type' => $fieldData['type'],
                        'options' => $fieldData['options'] ?? null,
                        'is_required' => isset($fieldData['is_required']) ? true : false,
                    ]);
                }
            }
            $this->timelineRepository->newTimeline('create', 'service', $service->id, $service->reference, $this->users);
            DB::commit();
            return ['success' => __('Service créé avec succès.'), 'id' => $service->id];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['error' => __('Une erreur est survenue. Veuillez réessayer.')];
        }
    }
    
    public function editService(Request $request, Service $service){
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|unique:services,name,' . $service->id,
                'description' => 'nullable|string',
                'documents' => 'nullable|array',
                'documents.*.name' => 'required|string|max:255',
                'documents.*.description' => 'nullable|string',
                'fields' => 'nullable|array',
                'fields.*.name' => 'required|string|max:255',
                'fields.*.description' => 'nullable|string',
                'fields.*.type' => 'required|in:short_text,long_text,number,date,datetime,single_select,multiple_select',
                'fields.*.options' => 'nullable',
            ]);
            if ($validator->fails()) {
                return ['error' => $validator->errors()->first()];
            }
            DB::beginTransaction();
            $service->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);
            $service->documents()->delete();
            if ($request->has('documents')) {
                foreach ($request->documents as $documentData) {
                    ServiceDocument::create([
                        'service_id' => $service->id,
                        'name' => $documentData['name'],
                        'description' => $documentData['description'] ?? null,
                        'is_required' => isset($documentData['is_required']) ? true : false,
                    ]);
                }
            }
            $service->fields()->delete();
            if ($request->has('fields')) {
                foreach ($request->fields as $fieldData) {
                    ServiceFormField::create([
                        'service_id' => $service->id,
                        'name' => $fieldData['name'],
                        'description' => $fieldData['description'] ?? null,
                        'type' => $fieldData['type'],
                        'options' => $fieldData['options'] ?? null,
                        'is_required' => isset($fieldData['is_required']) ? true : false,
                    ]);
                }
            }
            $this->timelineRepository->newTimeline('edit', 'service', $service->id, $service->reference, $this->users);
            DB::commit();
            return ['success' => __('Service modifié avec succès.'), 'id' => $service->id];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['error' => __('Une erreur est survenue. Veuillez réessayer.')];
        }
    }

    public function deleteService(Service $service){
        try {
            if ($service->demandes->count() == 0) {
                DB::beginTransaction();
                $r = $service->reference;
                $i = $service->id;
                $permission = Permission::where('name', $service->slug)->where('service_id', $service->id)->first();
                DB::table('role_has_permissions')->where('permission_id', $permission->id)->delete();
                DB::table('model_has_permissions')->where('permission_id', $permission->id)->delete();
                $permission->delete();
                ServiceDocument::where('service_id', $service->id)->delete();
                ServiceFormField::where('service_id', $service->id)->delete();
                $service->delete();
                $this->timelineRepository->newTimeline('delete', 'service', $i, $r, $this->users);
                DB::commit();
                return ['success' => __('Service supprimé avec succès.')];
            }else{
                return ['error' => __('This service has requests. They cannot be removed.')];
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return ['error' => __('Une erreur est survenue. Veuillez réessayer.')];
        }
    }

}