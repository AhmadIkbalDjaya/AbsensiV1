<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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

Route::resource('/location', LocationController::class);
Route::resource('/position', PositionController::class);
Route::resource('/shift', ShiftController::class);
Route::resource('/employee', EmployeeController::class);
