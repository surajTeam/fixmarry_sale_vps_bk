<?php

use App\Http\Controllers\Admin\Employee\AttendanceController;
use App\Http\Controllers\Admin\Employee\ManagementController;
use App\Http\Controllers\Admin\Employee\RegistrationController;




/*
|--------------------------------------------------------------------------
| Admin Employee Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [ManagementController::class, 'showEmployeeList']);


Route::get('register', [RegistrationController::class, 'showEmployeeRegistrationForm']);
Route::post('register', [RegistrationController::class, 'registerEmployee'])->name('employee.register');

Route::get('edit-profile/{fixmarry_employee_id}', [ManagementController::class, 'showEditEmployeeForm']);
Route::post('edit-profile', [ManagementController::class, 'editEmployee'])->name('employee.edit-profile');

Route::get('attendance', [AttendanceController::class, 'showAttendancePage']);