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
use \Modules\Recruitment\Http\Controllers\JobController;
use Modules\Recruitment\Http\Controllers\OfferController;
use Modules\Recruitment\Http\Controllers\InterviewController;
use Modules\Recruitment\Http\Controllers\JobApplicationController;

Route::prefix('recruitment')->name('recruitment.')->middleware(['auth'])->group(function () {

    Route::get('job-posting',  [JobController::class, 'index'])->name('jobPosting');
    Route::get('job-posting/add', [JobController::class, 'create'])->name('jobPosting.add');
    Route::post('job-posting/add', [JobController::class, 'store'])->name('jobPosting.store');
    Route::get('job-posting/{job}/edit', [JobController::class, 'edit'])->name('jobPosting.edit');
    Route::post('job-posting/{job}/update', [JobController::class, 'update'])->name('jobPosting.update');
    Route::post('job-posting/{job}/update', [JobController::class, 'update'])->name('jobPosting.update');
    Route::get('job-posting/{job}/trash', [JobController::class, 'trash'])->name('jobPosting.trash');
    Route::get('job-posting/{job}/delete', [JobController::class, 'destroy'])->name('jobPosting.delete');
    Route::get('job-posting/{job}/restore', [JobController::class, 'restore'])->name('jobPosting.restore');
    Route::get('job-posting/{job}/view', [JobController::class, 'show'])->name('jobPosting.view');

    //job applications
    Route::get('applications', [JobApplicationController::class, 'index'])->name('applications');
    Route::get('application/{application}/view', [JobApplicationController::class, 'show'])->name('application.view');
    Route::get('application/{application}/edit', [JobApplicationController::class, 'edit'])->name('application.edit');
    Route::post('application/{application}/update', [JobApplicationController::class, 'update'])->name('application.update');
    Route::get('application/{application}/trash', [JobApplicationController::class, 'trash'])->name('application.trash');
    Route::get('application/{application}/restore', [JobApplicationController::class, 'restore'])->name('application.restore');
    Route::get('application/{application}/delete', [JobApplicationController::class, 'delete'])->name('application.delete');
    Route::get('application/ajax', [JobApplicationController::class, 'getApplicationByJobId'])->name('application.ajax');

    //Interviews
    Route::get('interviews', [InterviewController::class, 'index'])->name('interviews');
    Route::get('interview/add', [InterviewController::class, 'create'])->name('interview.add');
    Route::post('interview/store', [InterviewController::class, 'store'])->name('interview.store');
    Route::get('interview/{interview}/show', [InterviewController::class, 'show'])->name('interview.view');
    Route::get('interview/{interview}/edit', [InterviewController::class, 'edit'])->name('interview.edit');
    Route::post('interview/{interview}/update', [InterviewController::class, 'update'])->name('interview.update');
    Route::get('interview/{interview}/trash', [InterviewController::class, 'trash'])->name('interview.trash');
    Route::get('interview/{interview}/restore', [InterviewController::class, 'restore'])->name('interview.restore');
    Route::get('interview/{interview}/delete', [InterviewController::class, 'delete'])->name('interview.delete');

    //Job Offer
    Route::get('offers', [OfferController::class, 'index'])->name('offers');
    Route::get('offer/add', [OfferController::class, 'create'])->name('offer.add');
    Route::post('offer/store', [OfferController::class, 'store'])->name('offer.store');
    Route::get('offer/{Job}/edit', [OfferController::class, 'edit'])->name('offer.edit');
    Route::post('offer/{Job}/update', [OfferController::class, 'update'])->name('offer.update');
    Route::get('offer/{Job}/view', [OfferController::class, 'show'])->name('offer.view');
    Route::get('offer/ajax', [OfferController::class, 'getSelectedCandidate'])->name('offer.ajax');

});
