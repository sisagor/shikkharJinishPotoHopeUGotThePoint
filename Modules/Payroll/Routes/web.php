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

use Modules\Payroll\Http\Controllers\SalaryStructureController;
use Modules\Payroll\Http\Controllers\PayrollController;

Route::prefix('payroll')->name('payroll.')->middleware('auth')->group(function () {
    //Structures
    Route::get('structures', [SalaryStructureController::class, 'index'])->name('structures');
    Route::get('structure/add', [SalaryStructureController::class, 'create'])->name('structure.add')->middleware('ajax');
    Route::post('structure/store', [SalaryStructureController::class, 'store'])->name('structure.store');
    Route::get('structure/{structure}/edit', [SalaryStructureController::class, 'edit'])->name('structure.edit')->middleware('ajax');
    Route::post('structure/{structure}/update', [SalaryStructureController::class, 'update'])->name('structure.update');
    Route::get('structure/{structure}/delete', [SalaryStructureController::class, 'destroy'])->name('structure.delete');

    //Salary Rules:
    Route::get('rules', [PayrollController::class, 'index'])->name('rules');
    Route::get('rule/add', [PayrollController::class, 'create'])->name('rule.add');
    Route::post('rule/store', [PayrollController::class, 'store'])->name('rule.store');
    Route::get('rule/{rule}/edit', [PayrollController::class, 'edit'])->name('rule.edit');
    Route::post('rule/{rule}/update', [PayrollController::class, 'update'])->name('rule.update');
    Route::get('rule/{rule}/delete', [PayrollController::class, 'destroy'])->name('rule.delete');
    Route::get('rule/{rule}/view', [PayrollController::class, 'show'])->name('rule.view')->middleware('ajax');

    #demo salary generation
    Route::get('salaries', [PayrollController::class, 'pendingSalaries'])->name('salaries');
    Route::get('pending-salaries', [PayrollController::class, 'pendingSalaries'])->name('pendingSalaries');
    Route::get('salary/{salary}/delete', [PayrollController::class, 'deleteSalary'])->name('salary.delete');
    Route::get('salary/{salary}/approve', [PayrollController::class, 'editSalary'])->name('salary.approve');
    Route::post('salary/{salary}/approve', [PayrollController::class, 'approveSalary'])->name('salary.approve.update');
    Route::get('approved-salaries', [PayrollController::class, 'approvedSalaries'])->name('approvedSalaries');
    Route::get('salary/{salary}/view', [PayrollController::class, 'viewSalary'])->name('salary.view');

    Route::get('salary-generate', [PayrollController::class, 'salaryGenerate'])->name('salaryGenerate');
    Route::post('salary-generate', [PayrollController::class, 'salaryGenerateStore'])->name('salaryGenerate.store');

    Route::post('salary/{salary}/pay', [PayrollController::class, 'salaryPayStore'])->name('salaryPay');
    Route::get('salary/{salary}/payslip', [PayrollController::class, 'payslip'])->name('salary.payslip');
    Route::get('salary/{salary}/payslip/print', [PayrollController::class, 'payslipPrint'])->name('salary.payslip.print');

});
