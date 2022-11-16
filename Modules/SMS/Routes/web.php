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

use Modules\SMS\Http\Controllers\SMSController;

Route::prefix('sms')->name('sms.')->middleware(['auth'])->group(function () {

    Route::get('sms-log', [SMSController::class, 'index'])->name('sms');
    Route::get('sms/add', [SMSController::class, 'create'])->name('sms.add');
    Route::post('sms/store', [SMSController::class, 'store'])->name('sms.store');
    Route::post('sms/delete', [SMSController::class, 'store'])->name('sms.delete');

});
