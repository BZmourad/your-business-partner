<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Contact;
use SEO;

class WelcomeController extends Controller
{
    public function index(Request $request){
        if (env('MODE_VITRINE', 0) == -1) {
            return redirect()->route('home');
        }
        $lang = 'fr';
        if (auth()->check()) {
            $lang = auth()->user()->lang;
        } else {
            $browserLanguages = $request->getLanguages();
            foreach ($browserLanguages as $browserLanguage) {
                $simpleLocale = explode('-', $browserLanguage)[0];
                if (in_array($simpleLocale, ['ar', 'fr', 'en'])) {
                    $lang = $simpleLocale;
                }
            }
        }
        return redirect()->route($lang.'.welcome');
    }

    public function index_en(){
        if (env('MODE_VITRINE', 0) == -1) {
            return redirect()->route('home');
        }
        $l = "en";
        $this->setHomeSEO($l);
        return view('welcome.index', compact('l'));
    }

    public function index_fr(){
        if (env('MODE_VITRINE', 0) == -1) {
            return redirect()->route('home');
        }
        $l = "fr";
        $this->setHomeSEO($l);
        return view('welcome.index', compact('l'));
    }

    public function index_ar(){
        if (env('MODE_VITRINE', 0) == -1) {
            return redirect()->route('home');
        }
        $l = "ar";
        $this->setHomeSEO($l);
        return view('welcome.index', compact('l'));
    }

    public function service_en($slug){
        if (env('MODE_VITRINE', 0) == -1) {
            return redirect()->route('home');
        }
        $l = "en";
        return view('welcome.service', compact('l', 'slug'));
    }

    public function service_fr($slug){
        if (env('MODE_VITRINE', 0) == -1) {
            return redirect()->route('home');
        }
        $l = "fr";
        return view('welcome.service', compact('l', 'slug'));
    }

    public function service_ar($slug){
        if (env('MODE_VITRINE', 0) == -1) {
            return redirect()->route('home');
        }
        $l = "ar";
        return view('welcome.service', compact('l', 'slug'));
    }

    public function contact(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'service' => 'nullable',
                'email' => 'nullable|email',
                'phone' => 'required|string',
                'address' => 'nullable|string',
                'subject' => 'required|string',
                'message' => 'required|string|min:10'
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->first()]);
            }
            DB::beginTransaction();
            $contact = Contact::create($request->all());
            $contact->update(['reference'=>getRefrence($contact->id, "CT")]);
            DB::commit();
            return response()->json(['success' => __('Action successfully completed.')]);
        } catch (\Exception $e) {
            DB::rollBack();
            elog($e);
            return response()->json(['error' =>  __('Une erreur est survenue. Veuillez réessayer.')]);
        }
    }

    private function setHomeSEO($lang){
        if (env('SEO_ACTIVE', 0) == 1) {
            
        }
    }
    
}
