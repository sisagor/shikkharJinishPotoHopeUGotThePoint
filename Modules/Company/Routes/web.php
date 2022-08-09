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
use Modules\Company\Http\Controllers\CompanyController;

Route::prefix('company')->name('company.')->middleware(['auth'])->group(function() {

    Route::get('companies', [CompanyController::class, 'index'])->name('companies');
    Route::get('company/add', [CompanyController::class, 'create'])->name('company.add');
    Route::post('company/store', [CompanyController::class, 'store'])->name('company.store');
    Route::get('company/{company}/edit', [CompanyController::class, 'edit'])->name('company.edit');
    Route::post('company/{company}/update', [CompanyController::class, 'update'])->name('company.update');
    Route::get('company/{company}/delete', [CompanyController::class, 'destroy'])->name('company.delete');
    Route::get('company/{company}/profile', [CompanyController::class, 'profile'])->name('company.profile');
    Route::post('company/{company}/profile/update', [CompanyController::class, 'profileUpdate'])->name('company.profile.update');
    Route::get('company/{company}/trash', [CompanyController::class, 'trash'])->name('company.trash');
    Route::get('company/{company}/restore', [CompanyController::class, 'restore'])->name('company.restore');



    //Settings route
    Route::get('company/settings', [CompanyController::class, 'settings'])->name('company.settings');
    Route::post('company/update/settings/', [CompanyController::class, 'settingsUpdate'])->name('company.settings.update');
    Route::get('company/settings/device/ajax', [CompanyController::class, 'deviceTest'])->name('settings.device.test');


});
