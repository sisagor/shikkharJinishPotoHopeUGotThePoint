<?php
//import all class needs
use Illuminate\Support\Facades\Route;
use Modules\Report\Http\Controllers\ReportController;


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

Route::prefix('reports')->name('reports.')->middleware(['auth'])->group(function () {

    //Attendance Report;
    Route::get('attendance', [ReportController::class, 'attendance'])->name('attendance');

    Route::get('attendance-month-wise', [ReportController::class, 'attendanceMonthWise'])->name('attendanceMonthWise');

    //Salary Report
    Route::get('salary', [ReportController::class, 'salary'])->name('salary');

    //Leave report
    Route::get('leave', [ReportController::class, 'leave'])->name('leave');
    //Route::get('report/view', [ReportController::class, 'leave'])->name('report.view');

});
