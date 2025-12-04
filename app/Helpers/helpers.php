<?php

use Illuminate\Support\Facades\Log;
use App\Models\Customer\Customer;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Timeline;
use Illuminate\Support\Facades\File;

if (! function_exists('wlog')) {
    function wlog($str){
        Log::info('wlog '.$str);
    }
}

if (! function_exists('getCustomer')) {
    function getCustomer(){
        $customer = Customer::findOrFail(Auth::user()->customer_id);
        return $customer;
    }
}

if (! function_exists('getRefrence')) {
    function getRefrence($id, $p){
        $year = Carbon::now()->format('y');
        $res = $p.$year;
        $numlength = strlen((string)$id);
        for ($i=0; $i < 6-$numlength; $i++) {
            $res .= "0";
        }
        $res = $res.$id;
        return $res;
    }
}

if (! function_exists('elog')) {
    function elog(\Exception $e){
        Log::error('elog: \n'.
        '-message: '.$e->getMessage().'\n'.
        '-file: '.$e->getFile().'\n'.
        '-line: '.$e->getLine().'\n'.
        '-code: '.$e->getCode().'\n'.
        '-trace: '.$e->getTraceAsString());
    }
}

if (! function_exists('createUniqueSlug')) {
    function createUniqueSlug($title, $model = null){
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 1;
        if ($model) {
            while ($model::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }
        }
        return $slug;
    }
}

if (! function_exists('countries')) {
    function countries(){
        $json = File::get(public_path('data/countries.json'));
        $countries = json_decode($json, true);
        return $countries;
    }
}

if (! function_exists('nationalities')) {
    function nationalities(){
        $json = File::get(public_path('data/nationalities.json'));
        $nationalities = json_decode($json, true);
        return $nationalities;
    }
}

if (! function_exists('phoneCountries')) {
    function phoneCountries(){
        $json = File::get(public_path('data/tel.json'));
        $countries = json_decode($json, true);
        return $countries;
    }
}

if (! function_exists('country')) {
    function country($code){
        $json = File::get(public_path('data/countries.json'));
        $countries = json_decode($json, true);
        foreach ($countries as $item) {
            if ($item['code'] == $code) {
                return $item['name_'.auth()->user()->lang];
            }
        }
        return '';
    }
}

if (! function_exists('nationality')) {
    function nationality($code){
        $json = File::get(public_path('data/nationalities.json'));
        $nationalities = json_decode($json, true);
        foreach ($nationalities as $item) {
            if ($item['code'] == $code) {
                return $item['name_'.auth()->user()->lang];
            }
        }
        return '';
    }
}

if (!function_exists('timezones')) {
    function timezones(){
        $json = File::get(public_path('data/timezone.json'));
        $timezones = json_decode($json, true);
        return $timezones;
    }
}