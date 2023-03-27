<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CutyController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SwSiteController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\MasterData\ShiftController;
use App\Http\Controllers\MasterData\EmployeeController;
use App\Http\Controllers\MasterData\LocationController;
use App\Http\Controllers\MasterData\PositionController;

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
Route::resource('/admin', AdminController::class);
Route::post('/updatePassword/{employee}', [EmployeeController::class, 'updatePassword']);

Route::resource('/employee', EmployeeController::class);
Route::resource('/position', PositionController::class);
Route::resource('/location', LocationController::class);
Route::resource('/shift', ShiftController::class);

Route::get('/cutyRequest', [CutyController::class, 'cutyRequest']);
Route::post('/cutyAction/{cuty}', [CutyController::class, 'cutyAction']);

Route::get('/presence', [PresenceController::class, 'showAllPresence']);
Route::get('/employeePresence/{employee}', [PresenceController::class, 'employeePresence']);

Route::controller(SwSiteController::class)->group(function () {
    Route::get('/webSettings', 'webSettings');
    Route::post('/updateWebSettings', 'updateWebSettings');
    Route::get('/editProfile', "editProfile");
    Route::post('/updateProfile', "updateProfile");
});

Route::middleware(['auth:sanctum'])->group(function () {
  Route::middleware(['admin'])->group(function () {
  });
  Route::get('/logout', [AuthenticationController::class, 'logout']);
});

Route::post('/login', [AuthenticationController::class, 'login']);
