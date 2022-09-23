<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\EmployeeAttendanceController;
use App\Models\SalesRole;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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

Route::get('/', function () {

    $employee_role_id = Session::get('sales_employee_role_id');
    $role = SalesRole::where('id', $employee_role_id)->first()['name'];

    switch ($role) {
    	case 'admin':
    		return redirect(url('admin'));
    		break;
    	case 'team_leader':
    		return redirect(url('team-leader'));
    		break;
    	case 'telemarketing_executive':
    		return redirect(url('telemarketing-executive'));
    		break;
    	
    }
})->middleware('employee-auth');

Route::get('login', [LoginController::class, 'showLoginPage']);
Route::post('login', [LoginController::class, 'employeeLogin'])->name('employee.login');

Route::get('forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm']);
Route::post('forgot-password', [ForgotPasswordController::class, 'sendPasswordResetLink'])->name('employee.forgot-password');

Route::get('forgot-password-otp/{email}', [ForgotPasswordController::class, 'showOtpForm']);
Route::post('forgot-password-otp', [ForgotPasswordController::class, 'verifyOtp'])->name('employee.forgot-password-otp');

Route::get('reset-password/{email}', [ForgotPasswordController::class, 'showResetPasswordForm']);
Route::post('reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('employee.reset-password');


Route::get('punch-in', [EmployeeAttendanceController::class, 'showPunchInPage'])->middleware('employee-auth');
Route::post('punch-in', [EmployeeAttendanceController::class, 'punchIn'])->name('employee.punch_in')->middleware('employee-auth');

Route::get('punch-out', [EmployeeAttendanceController::class, 'showPunchOutPage'])->middleware(['employee-auth', 'check_punch_in']);
Route::post('punch-out', [EmployeeAttendanceController::class, 'punchOut'])->name('employee.punch_out')->middleware(['employee-auth', 'check_punch_in']);

Route::post('logout', 'LogoutController@logout')->name('logout');
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});