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

use Modules\Timesheet\Http\Controllers\LeaveController;
use Modules\Timesheet\Http\Controllers\AttendanceController;
use Modules\Timesheet\Http\Controllers\TimesheetController;

Route::prefix('timesheet')->name('timesheet.')->middleware('auth')->group(function () {


    ##Leave Applications
    Route::get('dashboard', [TimesheetController::class, 'index'])->name('dashboard');
    Route::get('dashboard/getAtt/ajax', [TimesheetController::class, 'getEmpAttMonthData'])->name('dashboard.getAtt');
    Route::get('leaves', [LeaveController::class, 'index'])->name('leaves');
    Route::get('leave/approved', [LeaveController::class, 'approvedApplications'])->name('leave.approved');
    Route::get('leave/rejected', [LeaveController::class, 'rejectedApplication'])->name('leave.rejected');
    Route::get('leave/add', [LeaveController::class, 'create'])->name('leave.add');
    Route::post('leave/store', [LeaveController::class, 'store'])->name('leave.store');
    Route::get('leave/{leave}/view', [LeaveController::class, 'show'])->name('leave.view');
    Route::post('leave/{leave}/approve', [LeaveController::class, 'approve'])->name('leave.approve');
    Route::get('leave/ajax', [LeaveController::class, 'getLeavePolicyByEmployee'])->name('leave.getLeaveType');

    ##Attendances
    Route::get('attendances', [AttendanceController::class, 'index'])->name('attendances');
    //Route::get('attendance/view', [AttendanceController::class, 'index'])->name('attendance.view');
    Route::get('punch-log', [AttendanceController::class, 'punchLog'])->name('punchLog');
    Route::get('absent', [AttendanceController::class, 'absent'])->name('absent');
    Route::get('on-leave', [AttendanceController::class, 'onLeave'])->name('onLeave');
    Route::get('attendance/add', [AttendanceController::class, 'create'])->name('attendance.add');
    Route::post('attendance/store', [AttendanceController::class, 'store'])->name('attendance.store');
    Route::get('attendance/{attendance}/edit', [AttendanceController::class, 'edit'])->name('attendance.edit');
    Route::post('attendance/{attendance}/update', [AttendanceController::class, 'singleCheckout'])->name('attendance.update');
    Route::get('attendance/{attendance}/delete', [AttendanceController::class, 'destroy'])->name('attendance.delete');
    Route::get('attendance/{attendance}/view', [AttendanceController::class, 'show'])->name('attendance.view');




});
