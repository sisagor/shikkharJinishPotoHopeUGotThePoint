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
use Modules\Billing\Http\Controllers\BillingController;
use Modules\Billing\Http\Controllers\ProjectController;

Route::prefix('billing')->name('billing.')->middleware(['auth'])->group(function() {

    Route::get('projects', [ProjectController::class, 'index'])->name('projects');
    Route::get('project/add', [ProjectController::class, 'create'])->name('project.add');
    Route::post('project/store', [ProjectController::class, 'store'])->name('project.store');
    Route::get('project/{project}/edit', [ProjectController::class, 'edit'])->name('project.edit');
    Route::post('project/{project}/update', [ProjectController::class, 'update'])->name('project.update');
    Route::get('project/{project}/trash', [ProjectController::class, 'trash'])->name('project.trash');
    Route::get('project/{project}/restore', [ProjectController::class, 'restore'])->name('project.restore');
    Route::get('project/{project}/delete', [ProjectController::class, 'delete'])->name('project.delete');

    //billing
    Route::get('bill/pending', [BillingController::class, 'pending'])->name('bill.pending');
    Route::get('bill/approved', [BillingController::class, 'approved'])->name('bill.approved');
    Route::get('bill/add', [BillingController::class, 'create'])->name('bill.add');
    Route::post('bill/store', [BillingController::class, 'store'])->name('bill.store');
    Route::get('bill/{bill}/edit', [BillingController::class, 'edit'])->name('bill.edit');
    Route::post('bill/{bill}/update', [BillingController::class, 'update'])->name('bill.update');
    Route::get('bill/{bill}/approve', [BillingController::class, 'approve'])->name('bill.approve');
    Route::get('bill/{bill}/trash', [BillingController::class, 'trash'])->name('bill.trash');
    Route::get('bill/{bill}/restore', [BillingController::class, 'restore'])->name('bill.restore');
    Route::get('bill/{bill}/delete', [BillingController::class, 'delete'])->name('bill.delete');
    Route::get('bill/{bill}/view', [BillingController::class, 'show'])->name('bill.view');
    Route::get('bill/report', [BillingController::class, 'report'])->name('bill.report');

});
