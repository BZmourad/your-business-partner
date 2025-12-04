<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index(){
        $customer = getCustomer();
        return view('customer.profile', compact('customer'));
    }
    public function update1(Request $request){
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'lang' => 'required',
        ]);
        if ($validator->fails()) {return redirect()->back()->with('error',$validator->errors()->first());}
        if($request->email != $user->email){
            $user->email_verified_at = null;
            $user->sendEmailVerificationNotification();
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->lang = $request->lang;
        $user->update();
        return redirect()->back()->with('success',__('Action successfully completed.'));
    }
    public function update2(Request $request){
        $validator = Validator::make($request->all(), [
            'avatar' => 'required|image|mimes:jpg,png,jpeg,gif,svg'
        ]);
        if ($validator->fails()) {return redirect()->back()->with('error',$validator->errors()->first());}
        $user = Auth::user();
        if ($user->avatar != 'avatar.png') {
            File::delete('storage/users/'.$user->avatar);
        }
        $imageName = time().'.'.$request->avatar->getClientOriginalExtension();
        $request->avatar->move('storage/users', $imageName);
        $user->avatar = $imageName;
        $user->update();
        return redirect()->back()->with('success',__('Action successfully completed.'));
    }
    public function update3(Request $request){
        $validator = Validator::make($request->all(), [
            'current_password' => ['required', new MatchOldPassword],
            'password' => ['required','min:8','alpha_num'],
            'password_confirmation' => ['same:password'],
        ]);
        if ($validator->fails()) {return redirect()->back()->with('error',$validator->errors()->first());}
        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->update();
        return redirect()->back()->with('success',__('Action successfully completed.'));
    }
}
