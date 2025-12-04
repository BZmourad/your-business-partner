<?php
namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Partner\Partner;
use Illuminate\Validation\Rules\Password as PasswordRule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use App\Repositories\TimelineRepository;

class PartnerRepository
{
    protected $timelineRepository;
    protected $users;

    public function __construct(TimelineRepository $timelineRepository){
        $this->timelineRepository = $timelineRepository;
        $this->users = User::permission('partners')->get();
    }

    public function addPartner(Request $request){
        try {
            $rules = [
                'country' => 'nullable|string|max:255',
                'partner_type' => 'required|in:particulier,entreprise',
                'last_name' => 'required|string|max:255',
                'first_name' => 'required|string|max:255',
                'email' => 'required|email|unique:partners,email',
                'gender' => 'nullable|in:homme,femme',
                'birth_date' => 'nullable|date',
                'birth_place' => 'nullable|string|max:255',
                'nationality' => 'nullable|string|max:255',
                'marital_status' => 'nullable|in:single,married,divorced,widowed',
                'address' => 'nullable|string',
                'phone' => 'nullable|string|max:20',
                'fax' => 'nullable|string|max:20',
                'id_type' => 'nullable|in:cin,passport,other',
                'id_number' => 'nullable|string|max:50|unique:partners,id_number',
                'id_issue_date' => 'nullable|date',
                'id_issue_place' => 'nullable|string|max:255',
                'id_expiry_date' => 'nullable|date|after:id_issue_date',
                'profession' => 'nullable|string|max:255',
                'job_title' => 'nullable|string|max:255',
                'employer' => 'nullable|string|max:255',
                'work_address' => 'nullable|string',
                'work_phone' => 'nullable|string|max:20',
                'activity' => 'nullable|string|max:255',
                'tax_id' => 'nullable|string|max:50|unique:partners,tax_id',
                'tax_regime' => 'nullable|string|max:255',
                'commerce_register_number' => 'nullable|string|max:50',
                'business_sector' => 'nullable|string|max:255',
                'contacts' => 'nullable|array',
                'contacts.*.name' => 'nullable|string|max:255',
                'contacts.*.email' => 'nullable|email',
                'contacts.*.phone1' => 'nullable|string|max:255',
                'contacts.*.phone2' => 'nullable|string|max:255',
                'contacts.*.whatsapp' => 'nullable|string|max:255',
            ];
            if ($request->id_type == 'other') {
                $rules['id_type_other'] = ['required'];
            }
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return ['error' => $validator->errors()->first()];
            }
            DB::beginTransaction();
            $partner = Partner::create($request->all());
            $partner->update(['reference'=>getRefrence($partner->id, "PR")]);
            if ($request->has('contacts')) {
                foreach ($request->contacts as $contactData) {
                    if ($contactData['name'] || $contactData['email'] || $contactData['phone1'] || $contactData['phone2'] || $contactData['whatsapp']) {
                        $partner->contacts()->create([
                            'name' => $contactData['name'],
                            'email' => $contactData['email'],
                            'phone1' => $contactData['phone1'],
                            'phone2' => $contactData['phone2'],
                            'whatsapp' => $contactData['whatsapp']
                        ]);
                    }
                }
            }
            $this->timelineRepository->newTimeline('create', 'partner', $partner->id, $partner->reference, $this->users);
            DB::commit();
            return ['success' => __('Partner créé avec succès.'), 'id' => $partner->id];
        } catch (\Exception $e) {
            elog($e);
            DB::rollBack();
            return ['error' => __('Une erreur est survenue. Veuillez réessayer.')];
        }
    }
    
    public function editPartner(Request $request, Partner $partner){
        try {
            $rules = [
                'country' => 'nullable|string|max:255',
                'partner_type' => 'required|in:particulier,entreprise',
                'last_name' => 'required|string|max:255',
                'first_name' => 'required|string|max:255',
                'email' => 'required|email|unique:partners,email,' . $partner->id,
                'gender' => 'nullable|in:homme,femme',
                'birth_date' => 'nullable|date',
                'birth_place' => 'nullable|string|max:255',
                'nationality' => 'nullable|string|max:255',
                'marital_status' => 'nullable|in:single,married,divorced,widowed',
                'address' => 'nullable|string',
                'phone' => 'nullable|string|max:20',
                'fax' => 'nullable|string|max:20',
                'id_type' => 'nullable|in:cin,passport,other',
                'id_number' => 'nullable|string|max:50|unique:partners,id_number,' . $partner->id,
                'id_issue_date' => 'nullable|date',
                'id_issue_place' => 'nullable|string|max:255',
                'id_expiry_date' => 'nullable|date|after:id_issue_date',
                'profession' => 'nullable|string|max:255',
                'job_title' => 'nullable|string|max:255',
                'employer' => 'nullable|string|max:255',
                'work_address' => 'nullable|string',
                'work_phone' => 'nullable|string|max:20',
                'activity' => 'nullable|string|max:255',
                'tax_id' => 'nullable|string|max:50|unique:partners,tax_id,' . $partner->id,
                'tax_regime' => 'nullable|string|max:255',
                'commerce_register_number' => 'nullable|string|max:50',
                'business_sector' => 'nullable|string|max:255',
                'contacts' => 'nullable|array',
                'contacts.*.name' => 'nullable|string|max:255',
                'contacts.*.email' => 'nullable|email',
                'contacts.*.phone1' => 'nullable|string|max:255',
                'contacts.*.phone2' => 'nullable|string|max:255',
                'contacts.*.whatsapp' => 'nullable|string|max:255',
            ];
            if ($request->id_type == 'other') {
                $rules['id_type_other'] = ['required'];
            }
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return ['error' => $validator->errors()->first()];
            }
            DB::beginTransaction();
            $partner->update($request->all());
            $partner->contacts()->delete();
            if ($request->has('contacts')) {
                foreach ($request->contacts as $contactData) {
                    if ($contactData['name'] || $contactData['email'] || $contactData['phone1'] || $contactData['phone2'] || $contactData['whatsapp'] ) {
                        $partner->contacts()->create([
                            'name' => $contactData['name'],
                            'email' => $contactData['email'],
                            'phone1' => $contactData['phone1'],
                            'phone2' => $contactData['phone2'],
                            'whatsapp' => $contactData['whatsapp']
                        ]);
                    }
                }
            }
            $this->timelineRepository->newTimeline('edit', 'partner', $partner->id, $partner->reference, $this->users);
            DB::commit();
            return ['success' => __('Partner modifié avec succès.'), 'id' => $partner->id];
        } catch (\Exception $e) {
            elog($e);
            DB::rollBack();
            return ['error' => __('Une erreur est survenue. Veuillez réessayer.')];
        }
    }

    public function deletePartner($id){
        try {
            $partner = Partner::findOrFail($id);
            $r = $partner->reference;
            $i = $partner->id;
            $partner->contacts()->delete();
            $partner->delete();
            $this->timelineRepository->newTimeline('delete', 'partner', $i, $r, $this->users);
            DB::commit();
            return ['success' => __('Partner définitivement supprimé.')];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['error' => __('Une erreur est survenue lors de la suppression définitive.')];
        }
    }

}