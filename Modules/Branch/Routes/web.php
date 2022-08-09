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
use Modules\Branch\Http\Controllers\BranchController;


Route::prefix('branch')->name('branch.')->middleware(['auth'])->group(function() {

    Route::get('branches', [BranchController::class, 'index'])->name('branches');
    Route::get('branch/add', [BranchController::class, 'create'])->name('branch.add');
    Route::post('branch/store', [BranchController::class, 'store'])->name('branch.store');
    Route::get('branch/{branch}/edit', [BranchController::class, 'edit'])->name('branch.edit');
    Route::post('branch/{branch}/update', [BranchController::class, 'update'])->name('branch.update');
    Route::get('branch/{branch}/delete', [BranchController::class, 'destroy'])->name('branch.delete');
    Route::get('branch/{branch}/trash', [BranchController::class, 'trash'])->name('branch.trash');
    Route::get('branch/{branch}/restore', [BranchController::class, 'restore'])->name('branch.restore');
    Route::get('branch/getBranch/id', [BranchController::class, 'getBranch'])->name('branch.getBranch');
    Route::get('branch/{branch}/profile', [BranchController::class, 'profile'])->name('branch.profile');
    Route::post('branch/{branch}/profile/update', [BranchController::class, 'profileUpdate'])->name('branch.profile.update');

   //Settings Route
    Route::get('branch/settings', [BranchController::class, 'settings'])->name('branch.settings');
    Route::post('branch/settings', [BranchController::class, 'settingsUpdate'])->name('branch.settings.update');
    Route::get('branch/settings/device/ajax', [BranchController::class, 'deviceTest'])->name('settings.device.test');

});
