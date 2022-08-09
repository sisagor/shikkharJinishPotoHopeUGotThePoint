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
use \Modules\Loan\Http\Controllers\LoanController;
use \Modules\Loan\Http\Controllers\InstallmentController;

Route::prefix('loans')->name('loans.')->middleware(['auth'])->group(function () {
    //Departments

    Route::get('loan/pending', [LoanController::class, 'pending'])->name('loan.pending');
    Route::get('loan/approved', [LoanController::class, 'approved'])->name('loan.approved');
    Route::get('loan/released', [LoanController::class, 'released'])->name('loan.released');

    Route::get('loan/add', [LoanController::class, 'create'])->name('loan.add');
    Route::post('loan/store', [LoanController::class, 'store'])->name('loan.store');
    Route::get('loan/{loan}/edit', [LoanController::class, 'edit'])->name('loan.edit');
    Route::post('loan/{loan}/update', [LoanController::class, 'update'])->name('loan.update');
    Route::get('loan/{loan}/trash', [LoanController::class, 'trash'])->name('loan.trash');
    Route::get('loan/{loan}/restore', [LoanController::class, 'restore'])->name('loan.restore');
    Route::get('loan/{loan}/delete', [LoanController::class, 'delete'])->name('loan.delete');

    Route::get('installments/add', [InstallmentController::class, 'create'])->name('installments.add');
    Route::get('installments/store', [InstallmentController::class, 'store'])->name('installments.store');
    Route::get('installments/{id}/edit', [InstallmentController::class, 'edit'])->name('installments.edit');
    Route::get('installments/{id}/update', [InstallmentController::class, 'update'])->name('installments.update');
    Route::get('installments/{id}/delete', [InstallmentController::class, 'delete'])->name('installments.delete');

});
