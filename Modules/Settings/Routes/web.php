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
use Modules\Settings\Http\Controllers\BlogCategoryController;



Route::prefix('component-settings')->name('componentSettings.')->middleware(['auth'])->group(function () {

    ##Blog Categories
    Route::get('blog-categories', [BlogCategoryController::class, 'index'])->name('blogCategories');
    Route::get('blog-category/add', [BlogCategoryController::class, 'create'])->name('blogCategory.add');
    Route::post('blog-category/store', [BlogCategoryController::class, 'store'])->name('blogCategory.store');
    Route::get('blog-category/{blogCategory}/edit', [BlogCategoryController::class, 'edit'])->name('blogCategory.edit');
    Route::post('blog-category/{blogCategory}/update', [BlogCategoryController::class, 'update'])->name('blogCategory.update');
    Route::get('blog-category/{blogCategory}/delete', [BlogCategoryController::class, 'destroy'])->name('blogCategory.delete');
    Route::get('blog-category/{blogCategory}/trash', [BlogCategoryController::class, 'trash'])->name('blogCategory.trash');
    Route::get('blog-category/{blogCategory}/restore', [BlogCategoryController::class, 'restore'])->name('blogCategory.restore');


});
