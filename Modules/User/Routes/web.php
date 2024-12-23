<?php
//import all class needs
use Modules\User\Http\Controllers\UserController;
use Modules\User\Http\Controllers\RoleController;
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

Route::prefix('user-managements')->name('userManagements.')->middleware(['auth'])->group(function() {

    Route::get('users', [UserController::class, 'index'])->name('users');
    Route::get('user/add', [UserController::class, 'create'])->name('user.add');
    Route::post('user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('user/{profile}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::post('user/{profile}/update', [UserController::class, 'update'])->name('user.update');
    Route::get('user/{profile}/delete', [UserController::class, 'destroy'])->name('user.delete');
    Route::get('user/{profile}/trash', [UserController::class, 'trash'])->name('user.trash');
    Route::get('user/{profile}/restore', [UserController::class, 'restore'])->name('user.restore');


    //reset password from admin panel
    //Route::get('user/password-reset', [UserController::class, 'resetPassword'])->name('user.resetPass');
    //Route::post('user/password-reset', [UserController::class, 'updateResetPassword'])->name('user.resetPass');
    Route::post('user/get-user/ajax', [UserController::class, 'getUser'])->name('user.getUser');
    //Route::post('user/update-password', [UserController::class, 'updateResetPassword'])->name('user.updatePassword');
    Route::get('user/{profile}/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::post('user/{profile}/profile/update', [UserController::class, 'profileUpdate'])->name('user.profile.update');
    Route::get('user/{user}/password', [UserController::class, 'changePassword'])->name('user.pass');
    Route::post('user/{user}/password', [UserController::class, 'updatePassword'])->name('user.pass.update');
    //ajax
   //Route::get('user/getComBranch', [UserController::class, 'getCompanyOrBranch'])->name('user.getComBranch');

    /** Start Role */
    Route::get('roles', [RoleController::class, 'index'])->name('roles');
    Route::get('role/add', [RoleController::class, 'create'])->name('role.add');
    Route::post('role/store', [RoleController::class, 'store'])->name('role.store');
    Route::get('role/{id}/edit', [RoleController::class, 'edit'])->name('role.edit');
    Route::post('role/{id}/update', [RoleController::class, 'update'])->name('role.update');
    Route::get('role/{id}/delete', [RoleController::class, 'destroy'])->name('role.delete');
    Route::get('role/{id}/trash', [RoleController::class, 'trash'])->name('role.trash');
    Route::get('role/{id}/restore', [RoleController::class, 'restore'])->name('role.restore');


});
