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
use Modules\Wallet\Http\Controllers\WalletController;


Route::prefix('wallet')->name('wallet.')->middleware('auth')->group(function () {

    ##Leave Applications
    Route::get('wallet', [WalletController::class, 'index'])->name('dashboard')->name('wallet');
});
