<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix' => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace' => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('user', 'UserCrudController');
    Route::crud('gym-admin-users', 'GymAdminUsersCrudController');
    Route::crud('gym-members', 'GymMembersCrudController');
    Route::crud('gym-payment', 'GymPaymentCrudController');
    Route::crud('gym-check-ins', 'GymCheckInsCrudController');
    Route::crud('memberships', 'MembershipsCrudController');
}); // this should be the absolute last line of this file

Route::get('gym-check-ins/report', 'GymCheckInsCrudController@report')->name('report');

Route::get('gym-check-ins/report', 'GymCheckInsCrudController@report')->name('admin.gymcheckins.report');


