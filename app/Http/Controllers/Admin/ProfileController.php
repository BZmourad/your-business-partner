<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Repositories\TimelineRepository;
use App\Models\User;

class ProfileController extends Controller
{
    protected $timelineRepository;
    protected $users;

    public function __construct(TimelineRepository $timelineRepository){
        $this->timelineRepository = $timelineRepository;
        $this->users = User::permission('users')->get();
    }
    
    public function index(){
        return view('admin.profile');
    }

    public function update1(Request $request){
        try {
            $user = Auth::user();
            $email = $user->email;
            $validator = Validator::make($request->all(), [
                'lang' => 'required',
                'country' => 'nullable|string|max:255',
                'last_name' => 'required|string|max:255',
                'first_name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,'.$user->id,
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
                'job_title' => 'nullable|string|max:255',
            ]);
            if ($validator->fails()) {return response()->json(['error' => $validator->errors()->first()]);}
            DB::beginTransaction();
            $user->update($request->all());
            $user->name = $request->first_name.' '.$request->last_name;
            $user->update();
            if($request->email != $email){
                $user->email_verified_at = null;
                $user->sendEmailVerificationNotification();
            }
            $this->timelineRepository->newTimeline('edit', 'user', $user->id, $user->name, $this->users);
            DB::commit();
            return response()->json(['success' => __('Action successfully completed.'), 'refresh' => true]);
        } catch (\Exception $e) {
            elog($e);
            DB::rollBack();
            return response()->json(['error' => __('Une erreur est survenue. Veuillez réessayer.')]);
        }
    }

    public function update2(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'avatar' => 'required|image|mimes:jpg,png,jpeg|max:5120'
            ]);
            if ($validator->fails()) {return response()->json(['error' => $validator->errors()->first()]);}
            DB::beginTransaction();
            $user = Auth::user();
            $user->addDocument($request->avatar);
            $this->timelineRepository->newTimeline('edit', 'user', $user->id, $user->name, $this->users);
            DB::commit();
            return response()->json(['success' => __('Action successfully completed.'), 'refresh' => true]);
        } catch (\Exception $e) {
            elog($e);
            DB::rollBack();
            return response()->json(['error' => __('Une erreur est survenue. Veuillez réessayer.')]);
        }
    }

    public function update3(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'current_password' => ['required', new MatchOldPassword],
                'password' => ['required','min:8','alpha_num'],
                'password_confirmation' => ['same:password'],
            ]);
            if ($validator->fails()) {return response()->json(['error' => $validator->errors()->first()]);}
            DB::beginTransaction();
            $user = Auth::user();
            $user->password = Hash::make($request->password);
            $user->update();
            $this->timelineRepository->newTimeline('edit', 'user', $user->id, $user->name, $this->users);
            DB::commit();
            return response()->json(['success' => __('Action successfully completed.'), 'refresh' => true]);
        } catch (\Exception $e) {
            elog($e);
            DB::rollBack();
            return response()->json(['error' => __('Une erreur est survenue. Veuillez réessayer.')]);
        }
    }

    public function update4(){
        try {
            $user = Auth::user();
            $user->clearMediaCollection('avatar');
            $this->timelineRepository->newTimeline('edit', 'user', $user->id, $user->name, $this->users);
            return redirect()->back()->with('success',__('Action successfully completed.'));
        } catch (\Exception $e) {
            elog($e);
            return redirect()->back()->with('error',__('Une erreur est survenue. Veuillez réessayer.'));
        }
    }
}
