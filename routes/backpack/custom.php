<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\GymCheckInsCrudController;

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
    // Route::crud('gym-admin-users', 'GymAdminUsersCrudController');
    Route::crud('gym-members', 'GymMembersCrudController');
    Route::crud('gym-payment', 'GymPaymentCrudController');
    Route::crud('gym-check-ins', 'GymCheckInsCrudController');
    Route::crud('memberships', 'MembershipsCrudController');

    // Route::get('gym-check-ins/report', 'GymCheckInsCrudController@report')->name('admin.gymcheckins.report');

    // Route::get('/checkin', [Controller::class, 'view'])->name('checkins');
    Route::get('/report', [Controller::class, 'reports'])->name('reports');
    // Route::get('/filter-reports', [Controller::class, 'filterreports'])->name('filterreports');

    // Route::get('member', [Controller::class, 'members'])->name('member');
    Route::get('/member', [Controller::class, 'members'])->name('members');
    // Route::get('/filter-members', [Controller::class, 'filtermembers'])->name('filtermembers');

    // Route::get('payment', [Controller::class, 'payments'])->name('payment');
    Route::get('/payment', [Controller::class, 'payments'])->name('payments');
    // Route::get('/filter-payments', [Controller::class, 'filterpayments'])->name('filterpayments');

    // Route::get('/cashflow', [Controller::class, 'view'])->name('cashFlow');
    Route::get('/cashflow', [Controller::class, 'cashflow'])->name('cashFlow');
    // Route::get('/filter-cashflow', [Controller::class, 'filterCashFlow'])->name('filterCashFlow');
}); // this should be the absolute last line of this file


