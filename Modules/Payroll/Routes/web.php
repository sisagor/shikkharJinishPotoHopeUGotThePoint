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
    Route::get('structures', [SalaryStructureController::class, 'index'])->name('structures');
    Route::get('structure/add', [SalaryStructureController::class, 'create'])->name('structure.add')->middleware('ajax');
    Route::post('structure/store', [SalaryStructureController::class, 'store'])->name('structure.store');
    Route::get('structure/{structure}/edit', [SalaryStructureController::class, 'edit'])->name('structure.edit')->middleware('ajax');
    Route::post('structure/{structure}/update', [SalaryStructureController::class, 'update'])->name('structure.update');
    Route::get('structure/{structure}/delete', [SalaryStructureController::class, 'destroy'])->name('structure.delete');
    Route::get('structure/{structure}/trash', [SalaryStructureController::class, 'trash'])->name('structure.trash');
    Route::get('structure/{structure}/restore', [SalaryStructureController::class, 'restore'])->name('structure.restore');

    //Salary Rules:
    Route::get('rules', [PayrollController::class, 'index'])->name('rules');
    Route::get('rule/add', [PayrollController::class, 'create'])->name('rule.add');
    Route::post('rule/store', [PayrollController::class, 'store'])->name('rule.store');
    Route::get('rule/{rule}/edit', [PayrollController::class, 'edit'])->name('rule.edit');
    Route::post('rule/{rule}/update', [PayrollController::class, 'update'])->name('rule.update');
    Route::get('rule/{rule}/delete', [PayrollController::class, 'destroy'])->name('rule.delete');
    Route::get('rule/{rule}/view', [PayrollController::class, 'show'])->name('rule.view')->middleware('ajax');
    Route::get('rule/{rule}/trash', [PayrollController::class, 'destroy'])->name('rule.trash');
    Route::get('rule/{rule}/restore', [PayrollController::class, 'restore'])->name('rule.restore');
    Route::get('rule/grade', [PayrollController::class, 'gradeWiseRule'])->name('rule.grade');


    #demo salary generation
    Route::get('salaries', [SalaryController::class, 'pendingSalaries'])->name('salaries');
    Route::get('pending-salaries', [SalaryController::class, 'pendingSalaries'])->name('pendingSalaries');
    Route::get('salary/{salary}/delete', [SalaryController::class, 'deleteSalary'])->name('salary.delete');
    Route::get('salary/{salary}/approve', [SalaryController::class, 'editSalary'])->name('salary.approve');
    Route::post('salary/{salary}/approve', [SalaryController::class, 'approveSalary'])->name('salary.approve.update');
    Route::get('approved-salaries', [SalaryController::class, 'approvedSalaries'])->name('approvedSalaries');
    Route::get('salary/{salary}/view', [SalaryController::class, 'viewSalary'])->name('salary.view');
    Route::get('salary-generate', [SalaryController::class, 'salaryGenerate'])->name('salaryGenerate');
    Route::post('salary-generate', [SalaryController::class, 'salaryGenerateStore'])->name('salaryGenerate.store');
    Route::post('salary/{salary}/pay', [SalaryController::class, 'salaryPayStore'])->name('salaryPay');
    Route::get('salary/{salary}/payslip', [SalaryController::class, 'payslip'])->name('salary.payslip');
    Route::get('salary/{salary}/payslip/print', [SalaryController::class, 'payslipPrint'])->name('salary.payslip.print');

});
