<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;

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
    return view('welcome');
})->name('welcome');

Route::get('/process', [SearchController::class, 'process'])->name('process');

Route::get('/checkin', [SearchController::class, 'view'])->name('checkins');

// Route::get('/report', [SearchController::class, 'reports'])->name('reports');
// Route::get('/filter-reports', [SearchController::class, 'filterreports'])->name('filterreports');

// Route::get('/member', [SearchController::class, 'view'])->name('members');
// Route::get('/member', [SearchController::class, 'members'])->name('payments');
// Route::get('/filter-members', [SearchController::class, 'filtermembers'])->name('filtermembers');
// // Route::get('/member', [SearchController::class, 'GymMember'])->name('members');
// // Route::get('/filter-member', [SearchController::class, 'filtermembers'])->name('filtermembers');

// Route::get('/payment', [SearchController::class, 'view'])->name('payments');
// Route::get('/payment', [SearchController::class, 'payments'])->name('payments');
// Route::get('/filter-payments', [SearchController::class, 'filterpayments'])->name('filterpayments');

// Route::get('/cashflow', [SearchController::class, 'view'])->name('cashFlow');
// Route::get('/cashflow', [SearchController::class, 'cashflow'])->name('cashFlow');
// Route::get('/filter-cashflow', [SearchController::class, 'filterCashFlow'])->name('filterCashFlow');

// Route::get('/checkin/search', [SearchController::class, 'search'])->name('checkin-search');












