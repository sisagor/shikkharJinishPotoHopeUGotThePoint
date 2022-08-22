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
use Modules\Payroll\Http\Controllers\SalaryController;
use Modules\Payroll\Http\Controllers\PayrollController;
use Modules\Payroll\Http\Controllers\SalaryStructureController;


Route::prefix('payroll')->name('payroll.')->middleware('auth')->group(function () {
    //Structures
    Route::controller(SalaryStructureController::class)->group(function() {

        Route::get('structures', 'index')->name('structures');
        Route::get('structure/add','create')->name('structure.add')->middleware('ajax');
        Route::post('structure/store',  'store')->name('structure.store');
        Route::get('structure/{structure}/edit','edit')->name('structure.edit')->middleware('ajax');
        Route::post('structure/{structure}/update','update')->name('structure.update');
        Route::get('structure/{structure}/trash', 'trash')->name('structure.trash');
        Route::get('structure/{structure}/restore', 'restore')->name('structure.restore');
        Route::get('structure/{structure}/delete', 'destroy')->name('structure.delete');
    });

    //Salary Rules:
    Route::controller(PayrollController::class)->group(function() {

        Route::get('rules', 'index')->name('rules');
        Route::get('rule/add','create')->name('rule.add');
        Route::post('rule/store', 'store')->name('rule.store');
        Route::get('rule/{rule}/edit',  'edit')->name('rule.edit');
        Route::post('rule/{rule}/update','update')->name('rule.update');
        Route::get('rule/{rule}/trash', 'trash')->name('rule.trash');
        Route::get('rule/{rule}/restore', 'restore')->name('rule.restore');
        Route::get('rule/{rule}/delete', 'destroy')->name('rule.delete');
        Route::get('rule/{rule}/view', 'show')->name('rule.view')->middleware('ajax');

    });

    //salary generation
    Route::controller(SalaryController::class)->group(function() {

        Route::get('salaries', 'pendingSalaries')->name('salaries');
        Route::get('pending-salaries', 'pendingSalaries')->name('pendingSalaries');
        Route::get('salary/{salary}/delete','deleteSalary')->name('salary.delete');
        Route::get('salary/{salary}/approve','editSalary')->name('salary.approve');
        Route::post('salary/{salary}/approve', 'approveSalary')->name('salary.approve.update');
        Route::get('approved-salaries','approvedSalaries')->name('approvedSalaries');
        Route::get('salary/{salary}/view', 'viewSalary')->name('salary.view');
        Route::get('salary-generate', 'salaryGenerate')->name('salaryGenerate');
        Route::post('salary-generate', 'salaryGenerateStore')->name('salaryGenerate.store');
        Route::post('salary/{salary}/pay', 'salaryPayStore')->name('salaryPay');
        Route::get('salary/{salary}/payslip', 'payslip')->name('salary.payslip');
        Route::get('salary/{salary}/payslip/print', 'payslipPrint')->name('salary.payslip.print');
    });

});
