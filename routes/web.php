<?php

use Illuminate\Support\Facades\Route;

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

/* Route::get('/', function () {
    return view('welcome');
}); */

// Route::get('/', function () {
//     return view('landingpage.index');
// });

 
Route::get('/blank-dashboard', function () {
    return view('blank-dashboard');
});

Route::get('/categories', function () {
    return view('dashboard.categories');
});

Route::get('/portfolio-manager', function () {
    return view('dashboard.supplier.portfolio-manager');
});



Route::get('/customer-accounts', function () {
    return view('dashboard.customer.accounts');
});

Route::get('/customer-account-settings', function () {
    return view('dashboard.customer.account-settings');
});

Route::get('/customer-payment-methods', function () {
    return view('dashboard.customer.payment-methods');
});




Route::get('/supplier-accounts', function () {
    return view('dashboard.supplier.accounts');
});
Route::get('/supplier-account-settings', function () {
    return view('dashboard.supplier.account-settings');
});
Route::get('/supplier-payment-methods', function () {
    return view('dashboard.supplier.payment-methods');
});




Auth::routes(['verify' => true]);

Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth', 'verified'], function () {

    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/account-settings', [App\Http\Controllers\AccountController::class, 'index']);
    Route::post('/account-create_update', [App\Http\Controllers\AccountController::class, 'create_update']);
});

Route::get('/email/verify/{id}/{hash}', [App\Http\Controllers\Auth\RegisterController::class, 'verify'])->name('verification.verify');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

