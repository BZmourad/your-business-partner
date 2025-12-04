<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\RequestController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ConfigController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\TimelineController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\ContactController;

Route::prefix('admin')->as('admin.')->middleware(['auth', 'user-access:admin', 'verified', 'Language'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update1', [ProfileController::class, 'update1'])->name('profile.update1');
    Route::post('/profile/update2', [ProfileController::class, 'update2'])->name('profile.update2');
    Route::post('/profile/update3', [ProfileController::class, 'update3'])->name('profile.update3');
    Route::get('/profile/update4', [ProfileController::class, 'update4'])->name('profile.update4');

    Route::resource('customers', CustomerController::class);
    Route::get('/customers/{id}/downloadPDF', [CustomerController::class, 'downloadPDF'])->name('customers.downloadPDF');
    Route::get('/customers/{id}/activationAccount', [CustomerController::class, 'activationAccount'])->name('customers.activationAccount');
    Route::get('/customers/{id}/requests', [CustomerController::class, 'getRequests'])->name('customers.getRequests');
    Route::get('/customers/{id}/documents', [CustomerController::class, 'getDocuments'])->name('customers.getDocuments');
    Route::get('/customers/{id}/deleteAccount', [CustomerController::class, 'deleteAccount'])->name('customers.deleteAccount');
    Route::post('/customers/addAccount', [CustomerController::class, 'addAccount'])->name('customers.addAccount');
    Route::post('/customers/sendEmail', [CustomerController::class, 'sendEmail'])->name('customers.sendEmail');

    Route::resource('partners', PartnerController::class);

    Route::resource('services', ServiceController::class);
    Route::get('/services/{id}/activation', [ServiceController::class, 'activation'])->name('services.activation');

    Route::resource('requests', RequestController::class);
    Route::get('/chooseService', [RequestController::class, 'chooseService'])->name('requests.choose.services');
    Route::get('/requests/{id}/add', [RequestController::class, 'add'])->name('requests.add');
    Route::get('/requests/{id}/documents', [RequestController::class, 'getDocuments'])->name('requests.getDocuments');
    Route::post('/requests/setStatus', [RequestController::class, 'setStatus'])->name('requests.setStatus');
    Route::post('/requests/setStatusJSON', [RequestController::class, 'setStatusJSON'])->name('requests.setStatusJSON');
    Route::post('/requests/setPaidStatus', [RequestController::class, 'setPaidStatus'])->name('requests.setPaidStatus');
    Route::post('/requests/setPaidStatusJSON', [RequestController::class, 'setPaidStatusJSON'])->name('requests.setPaidStatusJSON');
    Route::post('/requests/updateForm', [RequestController::class, 'updateForm'])->name('requests.updateForm');
    Route::post('/requests/addComment', [RequestController::class, 'comment'])->name('requests.comment.add');
    Route::get('/requests/{id}/deleteComment', [RequestController::class, 'deleteComment'])->name('requests.comment.delete');
    Route::get('/requests/{id}/visibleComment', [RequestController::class, 'visibleComment'])->name('requests.comment.visible');

    Route::resource('documents', DocumentController::class);
    Route::post('/documents/sendEmail', [DocumentController::class, 'sendEmail'])->name('documents.sendEmail');
    Route::get('/documents/{id}/deleteMedia', [DocumentController::class, 'deleteMedia'])->name('documents.media.delete');
    Route::get('/documents/{id}/downloadMedia', [DocumentController::class, 'downloadMedia'])->name('documents.media.download');
    Route::get('/documents/{id}/download', [DocumentController::class, 'download'])->name('documents.download');
    Route::post('/documents/uploadMedia', [DocumentController::class, 'upload'])->name('documents.media.upload');
    Route::post('/documents/addComment', [DocumentController::class, 'comment'])->name('documents.comment.add');
    Route::get('/documents/{id}/deleteComment', [DocumentController::class, 'deleteComment'])->name('documents.comment.delete');
    Route::get('/documents/{id}/visibleComment', [DocumentController::class, 'visibleComment'])->name('documents.comment.visible');
    Route::post('/documents/updatePermission', [DocumentController::class, 'updatePermission'])->name('documents.permission.update');
    Route::post('/documents/updateDocument', [DocumentController::class, 'updateDocument'])->name('documents.updateDocument');
    Route::post('/documents/setMonth', [DocumentController::class, 'setMonth'])->name('documents.setMonth');
    
    Route::resource('settings', ConfigController::class);

    Route::get('/configuration/company', [ConfigController::class, 'getCompany'])->name('config.company.index');
    Route::post('/configuration/company', [ConfigController::class, 'setCompany'])->name('config.company.update');
    Route::get('/configuration/logo', [ConfigController::class, 'getLogo'])->name('config.logo.index');
    Route::post('/configuration/logo', [ConfigController::class, 'setLogo'])->name('config.logo.update');
    Route::get('/configuration/docs', [ConfigController::class, 'getDocs'])->name('config.docs.index');
    Route::post('/configuration/docs', [ConfigController::class, 'addDocs'])->name('config.docs.store');
    Route::post('/configuration/docs/update', [ConfigController::class, 'editDocs'])->name('config.docs.update');
    Route::get('/configuration/docs/{id}/delete', [ConfigController::class, 'deleteDocs'])->name('config.docs.delete');

    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{receiver_id}', [MessageController::class, 'list'])->name('messages.list');
    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
    Route::get('/messages/{id}/download', [MessageController::class, 'downloadAttachment'])->name('messages.downloadAttachment');
    Route::get('/messages/{receiver_id}/latest/{lastMessageId}', [MessageController::class, 'fetchLatest'])->name('messages.fetchLatest');
    Route::post('/messages/mark-as-read', [MessageController::class, 'markAsRead'])->name('messages.markAsRead');
    Route::get('/getunreadmessages', [MessageController::class, 'getunreadmessages'])->name('messages.getunreadmessages');

    Route::resource('roles', RoleController::class);

    Route::resource('users', UserController::class);
    Route::get('/users/{id}/activation', [UserController::class, 'activation'])->name('users.activation');

    Route::resource('reports', ReportController::class);

    Route::resource('timelines', TimelineController::class);

    Route::resource('contacts', ContactController::class);

});
