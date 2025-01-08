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
        Route::get('comments', 'comments')->name('comments');
        Route::get('comments/{comment}/approve',  'approveComment')->name('comments.approve');
        Route::get('comments/{comment}/delete',  'deleteComment')->name('comments.delete');
    });


    Route::controller(Modules\CMS\Http\Controllers\BookController::class)->group(function ()
    {
        //CMS/Content Management
        Route::get('books/', 'index')->name('books');
        Route::get('book/add',  'create')->name('book.add');
        Route::post('book/store',  'store')->name('book.store');
        Route::get('book/{book}/edit',  'edit')->name('book.edit');
        Route::post('book/{book}/update',  'update')->name('book.update');
        Route::get('book/{book}/view',  'show')->name('book.view');
        Route::get('book/{book}/trash',  'trash')->name('book.trash');
        Route::get('book/{book}/restore',  'restore')->name('book.restore');
        Route::get('book/{book}/delete',  'delete')->name('book.delete');
        Route::get('contact-us/', 'contactUs')->name('contact');
    });


});
