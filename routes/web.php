<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SystemSettingsController;
use App\Http\Controllers\frontEnd\FrontEndController;


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


Route::get('clear', function (\Illuminate\Http\Request $request)
{
    \Illuminate\Support\Facades\Artisan::call('optimize:clear');
    //\Illuminate\Support\Facades\Artisan::call('optimize');
    //clear attendance from machine;


    //Create symlink
   /* File::link(
        storage_path('app/public'), public_path('storage')
    );*/

    if ($request->get('ip'))
    {
        try {
            $zkt = new \App\Services\ZKTService($request->get('ip'));
            //dd($zkt->connect());
            //$zkt->clearAttendance();
            $zkt->connect();

            dd($zkt->getUser());
            dd($zkt->setUser(55, 55, 'Sagor', '12345', 0));

            return "attendance log clear success!";
        }
        catch (Exception $exception)
        {
            dd($exception);
        }
    }

    return "Cache cleared!";
});



##front-end
Route::get('/', [FrontEndController::class, 'index'])->name('home');
//Route::get('home', [FrontEndController::class, 'index'])->name('home');
//Route::get('blogs', [\App\Http\Controllers\frontEnd\BlogController::class, 'index'])->name('blogs');
//Route::get('blog/category', [\App\Http\Controllers\frontEnd\BlogController::class, 'catWiseBlogs'])->name('blog.cat');
Route::get('blog/category', [FrontEndController::class, 'catWiseBlogs'])->name('blog.cat');
Route::get('blog/{id}', [FrontEndController::class, 'blogDetails'])->name('blog');
Route::get('jobs/{id}/show', [FrontEndController::class, 'jobShow'])->name('job.show');
Route::get('jobs/{id}/apply', [FrontEndController::class, 'jobApply'])->name('job.apply');
Route::post('jobs/{id}/apply', [FrontEndController::class, 'jobApplyStore'])->name('job.apply.store');
Route::get('about-us', [FrontEndController::class, 'about'])->name('about');
Route::get('contact-us', [FrontEndController::class, 'contact'])->name('contact');
Route::post('comment', [FrontEndController::class, 'comment'])->name('comment');
Route::post('contact-store', [FrontEndController::class, 'storeContact'])->name('storeContact');
Route::post('email_subscription', [FrontEndController::class, 'storeEmail'])->name('email_subscription');
Route::get('filter-blogs', [FrontEndController::class, 'filterBlogs'])->name('filter_blogs');

/*Route::get('/', function ()
{
    return view('frontEnd.index');

    if (! auth()->user())
    {
        return redirect()->route('login');
    }
    return redirect('/dashboard');
});*/


Route::middleware('auth')->group(function ()
{
    Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');
    //Chart Request
    Route::get('dashboard/ajax/salary', [HomeController::class, 'salaries'])->name('dashboard.salary');
    Route::get('dashboard/ajax/attendance', [HomeController::class, 'attendances'])->name('dashboard.attendance');
    Route::get('dashboard/ajax/attendanceAvg', [HomeController::class, 'attendancesAverage'])->name('dashboard.attendanceAvg');
    Route::get('dashboard/ajax/todayAttendance', [HomeController::class, 'todayAttendance'])->name('dashboard.todayAttendance');
    Route::get('dashboard/ajax/holidays', [HomeController::class, 'holidays'])->name('dashboard.holidays');
    Route::get('dashboard/ajax/leavePolicy', [HomeController::class, 'leavePolicy'])->name('dashboard.leavePolicy');

    Route::get('action/missing', [HomeController::class, 'actionMissing'])->name('action.missing');

    //Admin settings
    Route::get('settings', [SystemSettingsController::class, 'index'])->name('settings');
    Route::post('settings/update', [SystemSettingsController::class, 'settingsUpdate'])->name('settings.update');
    //Sms Gateway update:
    Route::post('settings/smsGateway', [SystemSettingsController::class, 'smsGatewayUpdate'])->name('settings.smsGateway');
    Route::post('settings/seoStore', [SystemSettingsController::class, 'seoStore'])->name('settings.seoStore');
    //Optimize
    Route::get('settings/cache/clear', [SystemSettingsController::class, 'cacheClear'])->name('settings.cache.clear');
    Route::get('settings/optimize', [SystemSettingsController::class, 'optimize'])->name('settings.optimize');
    //Currency
    Route::post('country/ajax', [\App\Http\Controllers\CountryController::class, 'getCountry'])->name('getCountry');

    //Route Notifications
    Route::get('notifications', [HomeController::class, 'notifications'])->name('notifications');
    Route::get('notification/markAsRead', [HomeController::class, 'markAsRead'])->name('markAsRead');

    //Logout Route:
    Route::get('logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout']);

    Route::get('test', [\App\Http\Controllers\TestController::class, 'test']);
});
