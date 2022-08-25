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

Route::prefix('recruitment')->name('recruitment.')->middleware(['auth'])->group(function () {

    Route::controller(Modules\Recruitment\Http\Controllers\JobController::class)->group(function (){
        //jobPosting
        Route::get('job-posting',  'index')->name('jobPosting');
        Route::get('job-posting/add','create')->name('jobPosting.add');
        Route::post('job-posting/store','store')->name('jobPosting.store');
        Route::get('job-posting/{job}/edit','edit')->name('jobPosting.edit');
        Route::post('job-posting/{job}/update', 'update')->name('jobPosting.update');
        Route::post('job-posting/{job}/update', 'update')->name('jobPosting.update');
        Route::get('job-posting/{job}/trash',  'trash')->name('jobPosting.trash');
        Route::get('job-posting/{job}/delete',  'destroy')->name('jobPosting.delete');
        Route::get('job-posting/{job}/restore',  'restore')->name('jobPosting.restore');
        Route::get('job-posting/{job}/view',  'show')->name('jobPosting.view');
    });

    Route::controller(Modules\Recruitment\Http\Controllers\JobApplicationController::class)->group(function (){
        //jobApplications
        Route::get('applications',  'index')->name('applications');
        Route::get('application/{application}/view','show')->name('application.view');
        Route::get('application/{application}/edit',  'edit')->name('application.edit');
        Route::post('application/{application}/update', 'update')->name('application.update');
        Route::get('application/{application}/trash', 'trash')->name('application.trash');
        Route::get('application/{application}/restore', 'restore')->name('application.restore');
        Route::get('application/{application}/delete', 'delete')->name('application.delete');
        Route::get('application/ajax','getApplicationByJobId')->name('application.ajax');
    });

    Route::controller(Modules\Recruitment\Http\Controllers\InterviewController::class)->group(function (){
        //Interviews
        Route::get('interviews', 'index')->name('interviews');
        Route::get('interview/add', 'create')->name('interview.add');
        Route::post('interview/store', 'store')->name('interview.store');
        Route::get('interview/{interview}/show',  'show')->name('interview.view');
        Route::get('interview/{interview}/edit', 'edit')->name('interview.edit');
        Route::post('interview/{interview}/update',  'update')->name('interview.update');
        Route::get('interview/{interview}/trash', 'trash')->name('interview.trash');
        Route::get('interview/{interview}/restore',  'restore')->name('interview.restore');
        Route::get('interview/{interview}/delete',  'delete')->name('interview.delete');
    });

    Route::controller(Modules\Recruitment\Http\Controllers\OfferController::class)->group(function (){
        //Job Offer
        Route::get('offers', 'index')->name('offers');
        Route::get('offer/add',  'create')->name('offer.add');
        Route::post('offer/store',  'store')->name('offer.store');
        Route::get('offer/{offer}/edit',  'edit')->name('offer.edit');
        Route::post('offer/{offer}/update',  'update')->name('offer.update');
        Route::get('offer/{offer}/view',  'show')->name('offer.view');
        Route::get('offer/ajax', 'getSelectedCandidate')->name('offer.ajax');
        Route::get('offer/{offer}/trash',  'trash')->name('offer.trash');
        Route::get('offer/{offer}/restore',  'restore')->name('offer.restore');
        Route::get('offer/{offer}/delete',  'delete')->name('offer.delete');
    });

    Route::controller(Modules\Recruitment\Http\Controllers\CMSController::class)->group(function (){
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
