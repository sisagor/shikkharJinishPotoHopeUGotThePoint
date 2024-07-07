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

use Modules\Organization\Http\Controllers\DepartmentController;
use Modules\Organization\Http\Controllers\DesignationController;
use Modules\Organization\Http\Controllers\DeductionPolicyController;
use Modules\Organization\Http\Controllers\LeavePolicyController;

Route::prefix('organization')->name('organization.')->middleware(['auth'])->group(function () {
    //Departments
    Route::get('departments', [DepartmentController::class, 'index'])->name('departments');
    Route::get('department/add', [DepartmentController::class, 'create'])->name('department.add')->middleware('ajax');;
    Route::post('department/store', [DepartmentController::class, 'store'])->name('department.store');
    Route::get('department/view', [DepartmentController::class, 'show'])->name('department.view')->middleware('ajax');;
    Route::get('department/{department}/edit', [DepartmentController::class, 'edit'])->name('department.edit')->middleware('ajax');;
    Route::post('department/{department}/update', [DepartmentController::class, 'update'])->name('department.update');
    Route::get('department/{department}/delete', [DepartmentController::class, 'destroy'])->name('department.delete');
    Route::get('department/{department}/trash', [DepartmentController::class, 'trash'])->name('department.trash');
    Route::get('department/{department}/restore', [DepartmentController::class, 'restore'])->name('department.restore');

    //Designations
    Route::get('designations', [DesignationController::class, 'index'])->name('designations');
    Route::get('designation/add', [DesignationController::class, 'create'])->name('designation.add')->middleware('ajax');
    Route::post('designation/store', [DesignationController::class, 'store'])->name('designation.store');
    Route::get('designation/view', [DesignationController::class, 'show'])->name('designation.view')->middleware('ajax');;
    Route::get('designation/{designation}/edit', [DesignationController::class, 'edit'])->name('designation.edit')->middleware('ajax');
    Route::post('designation/{designation}/update', [DesignationController::class, 'update'])->name('designation.update');
    Route::get('designation/{designation}/delete', [DesignationController::class, 'destroy'])->name('designation.delete');
    Route::get('designation/{designation}/trash', [DesignationController::class, 'trash'])->name('designation.trash');
    Route::get('designation/{designation}/restore', [DesignationController::class, 'restore'])->name('designation.restore');
    Route::get('designation/getDesignation/ajax', [DesignationController::class, 'getDesignations'])->name('designation.get')->middleware('ajax');

    //Attendance Deduction policy
    Route::get('deduction-policies', [DeductionPolicyController::class, 'index'])->name('deductionPolicies');
    Route::get('deduction-policy/add', [DeductionPolicyController::class, 'create'])->name('deductionPolicy.add')->middleware('ajax');
    Route::post('deduction-policy/store', [DeductionPolicyController::class, 'store'])->name('deductionPolicy.store');
    Route::get('deduction-policy/{policy}/edit', [DeductionPolicyController::class, 'edit'])->name('deductionPolicy.edit')->middleware('ajax');
    Route::post('deduction-policy/{policy}/update', [DeductionPolicyController::class, 'update'])->name('deductionPolicy.update');
    Route::get('deduction-policy/{policy}/delete', [DeductionPolicyController::class, 'destroy'])->name('deductionPolicy.delete');
    Route::get('deduction-policy/{policy}/trash', [DeductionPolicyController::class, 'trash'])->name('deductionPolicy.trash');
    Route::get('deduction-policy/{policy}/restore', [DeductionPolicyController::class, 'restore'])->name('deductionPolicy.restore');

    //Attendance Deduction policy
    Route::get('leave-policies', [LeavePolicyController::class, 'index'])->name('leavePolicies');
    Route::get('leave-policy/add', [LeavePolicyController::class, 'create'])->name('leavePolicy.add')->middleware('ajax');
    Route::post('leave-policy/store', [LeavePolicyController::class, 'store'])->name('policy.store');
    Route::get('leave-policy/{policy}/edit', [LeavePolicyController::class, 'edit'])->name('leavePolicy.edit')->middleware('ajax');
    Route::post('leave-policy/{policy}/update', [LeavePolicyController::class, 'update'])->name('leavePolicy.update');
    Route::get('leave-policy/{policy}/delete', [LeavePolicyController::class, 'destroy'])->name('leavePolicy.delete');
    Route::get('leave-policy/{policy}/trash', [LeavePolicyController::class, 'trash'])->name('leavePolicy.trash');
    Route::get('leave-policy/{policy}/restore', [LeavePolicyController::class, 'restore'])->name('leavePolicy.restore');

});
