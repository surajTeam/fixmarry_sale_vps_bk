<?php

use App\Http\Controllers\Admin\Lead\RegistrationController;


/*
|--------------------------------------------------------------------------
| Admin Lead Routes
|--------------------------------------------------------------------------
|
*/

Route::get('register/step-one', [RegistrationController::class, 'showStepOne']);
Route::post('register/step-one', [RegistrationController::class, 'leadStore'])->name('lead');
