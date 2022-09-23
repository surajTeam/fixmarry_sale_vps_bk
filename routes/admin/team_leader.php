<?php

use App\Http\Controllers\Admin\TeamLeader\TMEManagementController;


/*
|--------------------------------------------------------------------------
| Admin Team Leader Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('assign-tme', [TMEManagementController::class, 'assignTeamLeaderForm']);
Route::post('assign-tme', [TMEManagementController::class, 'assignTeamLeader'])->name('team_leader.assign_tme');
Route::get('assign-lead', [TMEManagementController::class, 'assignLeadForm']);
Route::post('assign-lead', [TMEManagementController::class, 'assignLead'])->name('team_leader.assign_lead');
Route::get('list-lead', [TMEManagementController::class, 'listLead']);

Route::get('team-leader-list', [TMEManagementController::class, 'allTeamleaders']);
Route::get('add-comment/{id}', [TMEManagementController::class, 'addComment']);
Route::get('leads-comment/{id}',[TMEManagementController::class, 'LeadsComment']);
Route::get('tme-leads-list/{id}', [TMEManagementController::class, 'tlBasedTmeLeadsList']);
Route::get('view-tme/{id}', [TMEManagementController::class, 'viewTME']);
Route::post('update-comment', [TMEManagementController::class, 'Updatecomment']);

