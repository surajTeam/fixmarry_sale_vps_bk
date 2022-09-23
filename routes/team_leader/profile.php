<?php

use App\Http\Controllers\TeamLeader\DashboardController;




/*
|--------------------------------------------------------------------------
| Team Leader Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [DashboardController::class, 'showDashboard']);

Route::get('attendance', [DashboardController::class, 'showAttendanceDashboard']);
