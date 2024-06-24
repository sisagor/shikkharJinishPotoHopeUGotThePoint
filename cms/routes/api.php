<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ConfigController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\Auth\AuthenticationController;
use App\Http\Controllers\Api\Attendance\AttendanceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('api')->group(function (){

    Route::get('/config', [ConfigController::class, 'configuration']);
    Route::post('/login', [AuthenticationController::class, 'login']);
    //After Login

    Route::middleware(['jwt.verify'])->group(function (){
        //dashboard data;
        Route::get('dashboard', [DashboardController::class, 'AttSummery']);

        //Attendances;
        Route::get('punch-log', [AttendanceController::class, 'punchLog']);
        Route::get('attendance', [AttendanceController::class, 'index']);
        Route::post('new-punch', [AttendanceController::class, 'newPunch']);

        //Logout//
        Route::get('logout', [AuthenticationController::class, 'logout']);
    });

});



/*Doc

#Config:
url: config
method: get
Param: domain

#Login:
url: login
method: post
param: email, password

#Logout:
url: logout
method: get
param: token

#Punch Log:
url: punch-log
method: get
param: token = token

#Attendance:
url: attendance
method: get
param: token = token

#New Punch:
url: new-punch
method: post
param: token = token, punch_time, location, latitude, longitude, device_ip

#Dashboard:
url: dashboard
method: get
param: token = token

*/
