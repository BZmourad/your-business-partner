<?php
namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Customer\Customer;
use Illuminate\Validation\Rules\Password as PasswordRule;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use Mail;
use App\Mail\UserParameter;
use App\Repositories\TimelineRepository;

class CustomerRepository
{
    protected $timelineRepository;
    protected $users;

    public function __construct(TimelineRepository $timelineRepository){
        $this->timelineRepository = $timelineRepository;
        $this->users = User::permission('customers')->get();
    }
    
    public function addCustomer(Request $request){
        try {
            $rules = [
                'country' => 'nullable|string|max:255',
                'customer_type' => 'required|in:particulier,entreprise',
                'last_name' => 'required|string|max:255',
                'first_name' => 'required|string|max:255',
                'email' => 'required|email|unique:customers,email',
                'gender' => 'nullable|in:homme,femme',
                'birth_date' => 'nullable|date',
                'birth_place' => 'nullable|string|max:255',
                'nationality' => 'nullable|string|max:255',
                'marital_status' => 'nullable|in:single,married,divorced,widowed',
                'address' => 'nullable|string',
                'phone' => 'nullable|string|max:20',
                'fax' => 'nullable|string|max:20',
                'id_type' => 'nullable|in:cin,passport,other',
                'id_number' => 'nullable|string|max:50|unique:customers,id_number',
                'id_issue_date' => 'nullable|date',
                'id_issue_place' => 'nullable|string|max:255',
                'id_expiry_date' => 'nullable|date|after:id_issue_date',
                'profession' => 'nullable|string|max:255',
                'job_title' => 'nullable|string|max:255',
                'employer' => 'nullable|string|max:255',
                'work_address' => 'nullable|string',
                'work_phone' => 'nullable|string|max:20',
                'activity' => 'nullable|string|max:255',
                'tax_id' => 'nullable|string|max:50|unique:customers,tax_id',
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
            if ($request->has_account) {
                $rules['user_password'] = ['required', PasswordRule::min(8)->mixedCase()->letters()->numbers()];
                $rules['user_password_confirm'] = ['required', 'same:user_password'];
            }
            if ($request->id_type == 'other') {
                $rules['id_type_other'] = ['required'];
            }
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return ['error' => $validator->errors()->first()];
            }
            DB::beginTransaction();
            $customer = Customer::create($request->except(['user_password', 'user_password_confirm']));
            $customer->update(['reference'=>getRefrence($customer->id, "CL")]);
            if ($request->has('contacts')) {
                foreach ($request->contacts as $contactData) {
                    if ($contactData['name'] || $contactData['email'] || $contactData['phone1'] || $contactData['phone2'] || $contactData['whatsapp']) {
                        $customer->contacts()->create([
                            'name' => $contactData['name'],
                            'email' => $contactData['email'],
                            'phone1' => $contactData['phone1'],
                            'phone2' => $contactData['phone2'],
                            'whatsapp' => $contactData['whatsapp']
                        ]);
                    }
                }
            }
            $this->timelineRepository->newTimeline('create', 'customer', $customer->id, $customer->reference, $this->users);
            if ($request->has_account) {
                $user = User::create([
                    'name' => $customer->first_name.' '.$customer->last_name,
                    'email' => $customer->email,
                    'password' => Hash::make($request->user_password),
                    'type'=> 'customer',
                    'customer_id' => $customer->id
                ]);
                $user->sendEmailVerificationNotification();
                if (isset($request->user_send_email)) {
                    $this->sendUserEmail($user, $request->user_password);
                }
            }
            DB::commit();
            return ['success' => __('Client créé avec succès.'), 'id' => $customer->id];
        } catch (\Exception $e) {
            elog($e);
            DB::rollBack();
            return ['error' => __('Une erreur est survenue. Veuillez réessayer.')];
        }
    }
    
    public function editCustomer(Request $request, Customer $customer){
        try {
            $rules = [
                'country' => 'nullable|string|max:255',
                'customer_type' => 'required|in:particulier,entreprise',
                'last_name' => 'required|string|max:255',
                'first_name' => 'required|string|max:255',
                'email' => 'required|email|unique:customers,email,' . $customer->id,
                'gender' => 'nullable|in:homme,femme',
                'birth_date' => 'nullable|date',
                'birth_place' => 'nullable|string|max:255',
                'nationality' => 'nullable|string|max:255',
                'marital_status' => 'nullable|in:single,married,divorced,widowed',
                'address' => 'nullable|string',
                'phone' => 'nullable|string|max:20',
                'fax' => 'nullable|string|max:20',
                'id_type' => 'nullable|in:cin,passport,other',
                'id_number' => 'nullable|string|max:50|unique:customers,id_number,' . $customer->id,
                'id_issue_date' => 'nullable|date',
                'id_issue_place' => 'nullable|string|max:255',
                'id_expiry_date' => 'nullable|date|after:id_issue_date',
                'profession' => 'nullable|string|max:255',
                'job_title' => 'nullable|string|max:255',
                'employer' => 'nullable|string|max:255',
                'work_address' => 'nullable|string',
                'work_phone' => 'nullable|string|max:20',
                'activity' => 'nullable|string|max:255',
                'tax_id' => 'nullable|string|max:50|unique:customers,tax_id,' . $customer->id,
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
            $customer->update($request->all());
            $customer->contacts()->delete();
            if ($request->has('contacts')) {
                foreach ($request->contacts as $contactData) {
                    if ($contactData['name'] || $contactData['email'] || $contactData['phone1'] || $contactData['phone2'] || $contactData['whatsapp'] ) {
                        $customer->contacts()->create([
                            'name' => $contactData['name'],
                            'email' => $contactData['email'],
                            'phone1' => $contactData['phone1'],
                            'phone2' => $contactData['phone2'],
                            'whatsapp' => $contactData['whatsapp']
                        ]);
                    }
                }
            }
            if ($customer->user) {
                $email = $customer->user->email;
                $customer->user->update([
                    'name' => $customer->first_name.' '.$customer->last_name,
                    'email' => $customer->email,
                ]);
                if ($email != $customer->email) {
                    $user->sendEmailVerificationNotification();
                }
            }
            $this->timelineRepository->newTimeline('edit', 'customer', $customer->id, $customer->reference, $this->users);
            DB::commit();
            return ['success' => __('Client modifié avec succès.'), 'id' => $customer->id];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['error' => __('Une erreur est survenue. Veuillez réessayer.')];
        }
    }

    public function deleteCustomer($id){
        try {
            $customer = Customer::findOrFail($id);
            if ($customer->demandes->count() == 0) {
                DB::beginTransaction();
                $r = $customer->reference;
                $i = $customer->id;
                if ($customer->user) {
                    $customer->user->delete();
                }
                $customer->contacts()->delete();
                $customer->delete();
                $this->timelineRepository->newTimeline('delete', 'customer', $i, $r, $this->users);
                DB::commit();
                return ['success' => __('Client définitivement supprimé.')];
            } else {
                return ['error' => __('This client has requests. They cannot be removed.')];
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return ['error' => __('Une erreur est survenue lors de la suppression définitive.')];
        }
    }

    protected function sendUserEmail($user, $plainPassword){
        Mail::to($user->email)->queue(new UserParameter($user, $plainPassword));
    }
}