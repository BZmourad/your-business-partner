<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        if (Auth::user()->type == 'admin') {
            return redirect("/admin/home");
        } else if (Auth::user()->type == 'customer') {
            return redirect("/customer/home");
        }
    }
    
    public function setLang($lang){
        Auth::user()->update(['lang' => $lang]);
        return redirect()->back()->with('success', __('Action successfully completed.'));
    }
}
