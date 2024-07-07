<?php

use Illuminate\Support\Facades\Route;
use Modules\Settings\Http\Controllers\TaxController;
use Modules\Settings\Http\Controllers\ShiftController;
use Modules\Settings\Http\Controllers\HolidayController;
use Modules\Settings\Http\Controllers\LeaveTypeController;
use Modules\Settings\Http\Controllers\JobCategoryController;
use Modules\Settings\Http\Controllers\EmployeeTypeController;
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

Route::prefix('component-settings')->name('componentSettings.')->middleware(['auth'])->group(function () {

    ##Employee Types
    Route::get('employment-types', [EmployeeTypeController::class, 'index'])->name('employmentTypes');
    Route::get('employment-type/add', [EmployeeTypeController::class, 'create'])->name('employmentType.add');
    Route::post('employment-type/store', [EmployeeTypeController::class, 'store'])->name('employmentType.store');
    Route::get('employment-type/{type}/edit', [EmployeeTypeController::class, 'edit'])->name('employmentType.edit');
    Route::post('employment-type/{type}/update', [EmployeeTypeController::class, 'update'])->name('employmentType.update');
    Route::get('employment-type/{type}/trash', [EmployeeTypeController::class, 'trash'])->name('employmentType.trash');
    Route::get('employment-type/{type}/delete', [EmployeeTypeController::class, 'destroy'])->name('employmentType.delete');
    Route::get('employment-type/{type}/restore', [EmployeeTypeController::class, 'restore'])->name('employmentType.restore');


    ###Leave Types:
    Route::get('leave-types', [LeaveTypeController::class, 'index'])->name('leaveTypes');
    Route::get('leave-type/add', [LeaveTypeController::class, 'create'])->name('leaveType.add');
    Route::post('leave-type/store', [LeaveTypeController::class, 'store'])->name('leaveType.store');
    Route::get('leave-type/{leaveType}/edit', [LeaveTypeController::class, 'edit'])->name('leaveType.edit');
    Route::post('leave-type/{leaveType}/update', [LeaveTypeController::class, 'update'])->name('leaveType.update');
    Route::get('leave-type/{leaveType}/delete', [LeaveTypeController::class, 'destroy'])->name('leaveType.delete');
    Route::get('leave-type/{leaveType}/trash', [LeaveTypeController::class, 'trash'])->name('leaveType.trash');
    Route::get('leave-type/{leaveType}/restore', [LeaveTypeController::class, 'restore'])->name('leaveType.restore');

    ### taxes:
    Route::get('taxes', [TaxController::class, 'index'])->name('taxes');
    Route::get('tax/add', [TaxController::class, 'create'])->name('tax.add');
    Route::post('tax/store', [TaxController::class, 'store'])->name('tax.store');
    Route::get('tax/{tax}/edit', [TaxController::class, 'edit'])->name('tax.edit');
    Route::post('tax/{tax}/update', [TaxController::class, 'update'])->name('tax.update');
    Route::get('tax/{tax}/delete', [TaxController::class, 'destroy'])->name('tax.delete');
    Route::get('tax/{tax}/trash', [TaxController::class, 'trash'])->name('tax.trash');
    Route::get('tax/{tax}/restore', [TaxController::class, 'restore'])->name('tax.restore');


    ##Shift
    Route::get('shifts', [ShiftController::class, 'index'])->name('shifts');
    Route::get('shift/add', [ShiftController::class, 'create'])->name('shift.add');
    Route::post('shift/store', [ShiftController::class, 'store'])->name('shift.store');
    Route::get('shift/{shift}/edit', [ShiftController::class, 'edit'])->name('shift.edit');
    Route::post('shift/{shift}/update', [ShiftController::class, 'update'])->name('shift.update');
    Route::get('shift/{shift}/delete', [ShiftController::class, 'destroy'])->name('shift.delete');
    Route::get('shift/{shift}/trash', [ShiftController::class, 'trash'])->name('shift.trash');
    Route::get('shift/{shift}/restore', [ShiftController::class, 'restore'])->name('shift.restore');
    Route::get('shift/get-shift/ajax', [ShiftController::class, 'getShiftViaId'])->name('getShiftViaId');
    Route::get('shift/get-employee/ajax', [ShiftController::class, 'getEmployeeViaShift'])->name('getEmployeeViaShift');

    ##Holidays
    Route::get('holidays', [HolidayController::class, 'index'])->name('holidays');
    Route::get('holiday/add', [HolidayController::class, 'create'])->name('holiday.add');
    Route::post('holiday/store', [HolidayController::class, 'store'])->name('holiday.store');
    Route::get('holiday/{holiday}/delete', [HolidayController::class, 'destroy'])->name('holiday.delete');


    ##Job Categories
    Route::get('job-categories', [JobCategoryController::class, 'index'])->name('jobCategories');
    Route::get('job-category/add', [JobCategoryController::class, 'create'])->name('jobCategory.add');
    Route::post('job-category/store', [JobCategoryController::class, 'store'])->name('jobCategory.store');
    Route::get('job-category/{jobCategory}/edit', [JobCategoryController::class, 'edit'])->name('jobCategory.edit');
    Route::post('job-category/{jobCategory}/update', [JobCategoryController::class, 'update'])->name('jobCategory.update');
    Route::get('job-category/{jobCategory}/delete', [JobCategoryController::class, 'destroy'])->name('jobCategory.delete');
    Route::get('job-category/{jobCategory}/trash', [JobCategoryController::class, 'trash'])->name('jobCategory.trash');
    Route::get('job-category/{jobCategory}/restore', [JobCategoryController::class, 'restore'])->name('jobCategory.restore');

});
