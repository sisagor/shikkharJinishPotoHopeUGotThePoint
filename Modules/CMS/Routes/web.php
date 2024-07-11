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

Route::prefix('cms')->name('cms.')->middleware(['auth'])->group(function ()
{

    Route::controller(Modules\CMS\Http\Controllers\BlogController::class)->group(function ()
    {
        //jobPosting
        Route::get('blogs',  'index')->name('blogs');
        Route::get('blog/add','create')->name('blog.add');
        Route::post('blog/store','store')->name('blog.store');
        Route::get('blog/{blog}/edit','edit')->name('blog.edit');
        Route::post('blog/{blog}/update', 'update')->name('blog.update');
        Route::post('blog/{blog}/update', 'update')->name('blog.update');
        Route::get('blog/{blog}/trash',  'trash')->name('blog.trash');
        Route::get('blog/{blog}/delete',  'destroy')->name('blog.delete');
        Route::get('blog/{blog}/restore',  'restore')->name('blog.restore');
        Route::get('blog/{blog}/view',  'show')->name('blog.view');
    });


    Route::controller(Modules\CMS\Http\Controllers\CMSController::class)->group(function ()
    {
        //CMS/Content Management
        Route::get('cms', 'index')->name('cms');
        Route::get('cms/add',  'create')->name('cms.add');
        Route::post('cms/store',  'store')->name('cms.store');
        Route::get('cms/{cms}/edit',  'edit')->name('cms.edit');
        Route::post('cms/{cms}/update',  'update')->name('cms.update');
        Route::get('cms/{cms}/view',  'show')->name('cms.view');
        Route::get('cms/{cms}/delete',  'delete')->name('cms.delete');
    });


});
