<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\WelcomeController;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::get('/en', [WelcomeController::class, 'index_en'])->name('en.welcome');
Route::get('/fr', [WelcomeController::class, 'index_fr'])->name('fr.welcome');
Route::get('/ar', [WelcomeController::class, 'index_ar'])->name('ar.welcome');
Route::get('/en/{slug}', [WelcomeController::class, 'service_en'])->name('en.welcome.service');
Route::get('/fr/{slug}', [WelcomeController::class, 'service_fr'])->name('fr.welcome.service');
Route::get('/ar/{slug}', [WelcomeController::class, 'service_ar'])->name('ar.welcome.service');
Route::post('/contact', [WelcomeController::class, 'contact'])->name('welcome.contact');

Auth::routes(['verify' => true,'reset' => true,'register' => false]);
Route::view('403', 'errors.permission')->name('403');

Route::middleware(['auth', 'Language'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/setLang/{id}', [HomeController::class, 'setLang'])->name('setLang');
    Route::get('/inactive', function () { return view('auth.inactive');})->name('inactive');
});

Route::view('test', 'test');

Route::get('test-data', function () {
    $json = \Illuminate\Support\Facades\File::get(public_path('docs/d2.json'));
    $docs = json_decode($json, true);
    $data = [];
    foreach ($timezones as $v) {
        array_push($data, $v["en"]);
    }
    return $data;

});