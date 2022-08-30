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

Route::prefix('notification')->name('notification.')->middleware(['auth'])->group(function () {

    Route::controller( Modules\Notification\Http\Controllers\SMSController::class)->group(function(){
        //smsRoutes
        Route::get('sms/logs', 'index')->name('sms.logs');
        Route::get('sms/add','create')->name('sms.add');
        Route::post('sms/store','store')->name('sms.store');
        Route::get('sms/{sms}/delete', 'destroy')->name('sms.delete');
        //Schedule sms
        Route::get('sms/schedule/add','createScheduleSms')->name('sms.schedule.add');
        Route::post('sms/schedule/store', 'storeScheduleSms')->name('sms.schedule.store');
    });


    Route::controller(Modules\Notification\Http\Controllers\EmailController::class)->group(function(){
        //emailsRoutes
        Route::get('email/logs', 'index')->name('email.logs');
        Route::get('email/add', 'create')->name('email.add');
        Route::post('email/store','store')->name('email.store');
        Route::post('email/{email}/delete', 'destroy')->name('email.delete');
        Route::get('email/{email}view', 'show')->name('email.view');
        //Schedule Emails
        Route::get('email/schedule/add','createScheduleEmail')->name('email.schedule.add');
        Route::post('email/schedule/store', 'storeScheduleEmail')->name('email.schedule.store');
    });

});
