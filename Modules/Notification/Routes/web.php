<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;
use Modules\Notification\Http\Controllers\SMSController;
use Modules\Notification\Http\Controllers\EmailController;

Route::prefix('notification')->name('notification.')->middleware(['auth'])->group(function () {

    Route::get('sms/logs', [SMSController::class, 'index'])->name('sms.logs');
    Route::get('sms/add', [SMSController::class, 'create'])->name('sms.add');
    Route::post('sms/store', [SMSController::class, 'store'])->name('sms.store');
    Route::post('sms/delete', [SMSController::class, 'destroy'])->name('sms.delete');
    //Schedule sms
    Route::get('sms/schedule/add', [SMSController::class, 'scheduleSms'])->name('sms.schedule.add');
    Route::post('sms/schedule/add', [SMSController::class, 'scheduleSmsStore'])->name('sms.schedule.store');

    //Emails
    Route::get('emails', [EmailController::class, 'index'])->name('emails');
    Route::get('email/add', [EmailController::class, 'create'])->name('email.add');
    Route::post('email/store', [EmailController::class, 'store'])->name('email.store');
    Route::post('email/delete', [EmailController::class, 'destroy'])->name('email.delete');
    //Schedule Emails
    Route::get('email/schedule/add', [EmailController::class, 'scheduleEmail'])->name('email.schedule.add');
    Route::post('email/schedule/add', [EmailController::class, 'scheduleEmailStore'])->name('email.schedule.store');


});
