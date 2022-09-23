<?php

use App\Http\Controllers\TeamLeader\TMEManagementController;
use Illuminate\Support\Facades\Route;

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
Route::get('/', [TMEManagementController::class, 'tmeListPage']);
// Route::get('', [TMEManagementController::class, 'tmeListPage']);

Route::get('assign-lead', [TMEManagementController::class, 'assignLeadForm']);
Route::post('assign-lead', [TMEManagementController::class, 'assignLead'])->name('team_leader.assign_lead');
Route::get('leads-list',[TMEManagementController::class, 'leadsList']);
Route::get('tme-leads-list/{id}',[TMEManagementController::class, 'TMEleadsList']);
Route::get('tme-lead-list',[TMEManagementController::class, 'TMEParticularleadsList']);
Route::get('leads-comment/{id}',[TMEManagementController::class, 'LeadsComment']);
Route::get('edit-lead/{id}',[TMEManagementController::class, 'EditLead']);
Route::post('update-status', [TMEManagementController::class, 'UpdateLead']);

Route::get('edit-tme/{id}',[TMEManagementController::class, 'EditTME']);
Route::post('update-tme-comment', [TMEManagementController::class, 'UpdateTLComment']);
