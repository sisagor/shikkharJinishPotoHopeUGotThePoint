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

use Modules\Employee\Http\Controllers\EmployeeController;
use Modules\Employee\Http\Controllers\LeaveAssignController;

Route::prefix('employee')->name('employee.')->middleware(['auth'])->group(function () {

    ##Employee information
    Route::get('employees', [EmployeeController::class, 'index'])->name('employees');
    Route::get('employees/inactive', [EmployeeController::class, 'inactive'])->name('employees.inactive');

    Route::get('employee/add', [EmployeeController::class, 'create'])->name('employee.add');
    Route::post('employee/store', [EmployeeController::class, 'store'])->name('employee.store');
    Route::get('employee/{id}/edit', [EmployeeController::class, 'edit'])->name('employee.edit');
    Route::get('employee/{id}/view', [EmployeeController::class, 'show'])->name('employee.view');
    Route::post('employee/get-employee/ajax', [EmployeeController::class, 'getEmployeeAjax'])->name('getEmployee')->middleware('ajax');
    Route::get('employee/{id}/delete', [EmployeeController::class, 'destroy'])->name('employee.delete');
    Route::get('employee/{id}/trash', [EmployeeController::class, 'trash'])->name('employee.trash');
    Route::get('employee/{id}/restore', [EmployeeController::class, 'restore'])->name('employee.restore');

    //Import bulk employee:
    Route::get('employee/import', [EmployeeController::class, 'bulkUploadExample'])->name('import');
    Route::post('employee/import', [EmployeeController::class, 'bulkUpload'])->name('import.update');

    //Sync Company and branch employee with device:
    Route::get('device-sync/com/ajax', [EmployeeController::class, 'syncCompanyEmployeeWithDevice'])->name('device.sync.com')->middleware('ajax');
    Route::get('device-sync/branch/ajax', [EmployeeController::class, 'syncBranchEmployeeWithDevice'])->name('device.sync.branch')->middleware('ajax');

    ##Employment and personal update :
    Route::post('employment/{id}/update', [EmployeeController::class, 'updateEmploymentInfo'])->name('employment.update');
    Route::post('personal/{id}/update', [EmployeeController::class, 'updatePersonalInfo'])->name('personal.update');
    ##Employment and personal update :

    ##Educational information
    Route::get('educations', [EmployeeController::class, 'index'])->name('educations');
    Route::get('education/{employeeId}/add', [EmployeeController::class, 'createEducation'])->name('education.add');
    Route::post('education/store', [EmployeeController::class, 'storeEducation'])->name('education.store');
    Route::get('education/{education}/edit', [EmployeeController::class, 'editEducation'])->name('education.edit');
    Route::post('education/{education}/update', [EmployeeController::class, 'updateEducation'])->name('education.update');
    Route::get('education/{education}/delete', [EmployeeController::class, 'destroyEducation'])->name('education.delete');
    ##Educational information

    ##Addresss information
    Route::get('addresses', [EmployeeController::class, 'addresses'])->name('addresses');
    Route::get('address/{employeeId}/add', [EmployeeController::class, 'createAddress'])->name('address.add');
    Route::post('address/store', [EmployeeController::class, 'storeAddress'])->name('address.store');
    Route::get('address/{address}/edit', [EmployeeController::class, 'editAddress'])->name('address.edit');
    Route::post('address/{address}/update', [EmployeeController::class, 'updateAddress'])->name('address.update');
    Route::get('address/{address}/delete', [EmployeeController::class, 'destroyAddress'])->name('address.delete');

    ##Documents
    Route::get('documents', [EmployeeController::class, 'documents'])->name('documents');
    Route::get('document/{employeeId}/add', [EmployeeController::class, 'createDocument'])->name('document.add');
    Route::post('document/store', [EmployeeController::class, 'storeDocument'])->name('document.store');
    Route::get('document/{employee}/{document}/delete', [EmployeeController::class, 'destroyDocument'])->name('document.delete');

    ##Documents
    Route::get('get-policy/ajax', [EmployeeController::class, 'getLeavePolicy'])->name('getLeavePolicy');
    Route::get('get-taken-leave/ajax', [EmployeeController::class, 'getTakenLeave'])->name('getTakenLeave');

    #checck employee provision period
    Route::get('check-provision/ajax', [EmployeeController::class, 'checkProvisionPeriod'])->name('checkProvision');


});
