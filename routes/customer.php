<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\HomeController;
use App\Http\Controllers\Customer\ProfileController;
use App\Http\Controllers\Customer\RequestController;
use App\Http\Controllers\Customer\DocumentController;
use App\Http\Controllers\Customer\MessageController;

Route::prefix('customer')->as('customer.')->middleware(['auth', 'user-access:customer', 'verified', 'Language'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update1', [ProfileController::class, 'update1'])->name('profile.update1');
    Route::post('/profile/update2', [ProfileController::class, 'update2'])->name('profile.update2');
    Route::post('/profile/update3', [ProfileController::class, 'update3'])->name('profile.update3');

    Route::resource('requests', RequestController::class);
    Route::get('/chooseService', [RequestController::class, 'chooseService'])->name('requests.choose.services');
    Route::get('/requests/{id}/add', [RequestController::class, 'add'])->name('requests.add');

    Route::resource('documents', DocumentController::class);
    Route::post('/documents/sendEmail', [DocumentController::class, 'sendEmail'])->name('documents.sendEmail');
    Route::get('/documents/{id}/deleteMedia', [DocumentController::class, 'deleteMedia'])->name('documents.media.delete');
    Route::get('/documents/{id}/downloadMedia', [DocumentController::class, 'downloadMedia'])->name('documents.media.download');
    Route::get('/documents/{id}/download', [DocumentController::class, 'download'])->name('documents.download');
    Route::post('/documents/uploadMedia', [DocumentController::class, 'upload'])->name('documents.media.upload');
    Route::post('/documents/addComment', [DocumentController::class, 'comment'])->name('documents.comment.add');
    Route::get('/documents/{id}/deleteComment', [DocumentController::class, 'deleteComment'])->name('documents.comment.delete');
    Route::get('/documents/{id}/visibleComment', [DocumentController::class, 'visibleComment'])->name('documents.comment.visible');
    Route::post('/documents/updateDocument', [DocumentController::class, 'updateDocument'])->name('documents.updateDocument');

    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{receiver_id}', [MessageController::class, 'list'])->name('messages.list');
    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
    Route::get('/messages/{id}/download', [MessageController::class, 'downloadAttachment'])->name('messages.downloadAttachment');
    Route::get('/messages/{receiver_id}/latest/{lastMessageId}', [MessageController::class, 'fetchLatest'])->name('messages.fetchLatest');
    Route::post('/messages/mark-as-read', [MessageController::class, 'markAsRead'])->name('messages.markAsRead');
    Route::get('/getunreadmessages', [MessageController::class, 'getunreadmessages'])->name('messages.getunreadmessages');
});
