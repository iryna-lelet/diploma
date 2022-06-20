<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CurrenciesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IncomingsController;
use App\Http\Controllers\OutgoingsController;
use App\Http\Controllers\PaymentTypesController;
use App\Http\Controllers\SettingsController;
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

// Dashboard
Route::get('/logout', [DashboardController::class, 'logout'])->name('logout');

// Auth
Route::post('/signup/save', [AuthController::class, 'save'])->name('signup.save');
Route::post('/login/check', [AuthController::class, 'check'])->name('login.check');

/*
|--------------------------------------------------------------------------
| // Route group with middleware
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['AuthCheck']], function() {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Auth
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/signup', [AuthController::class, 'signup'])->name('signup');

    // Incomings
    Route::get('/incomings', [IncomingsController::class, 'index'])->name('incomings');
    Route::post('/incomings/store', [IncomingsController::class, 'store'])->name('incomings.store');
    Route::post('/incomings/destroy', [IncomingsController::class, 'destroy'])->name('incomings.destroy');

    // Outgoings
    Route::get('/outgoings', [OutgoingsController::class, 'index'])->name('outgoings');
    Route::post('/outgoings/store', [OutgoingsController::class, 'store'])->name('outgoings.store');
    Route::post('/outgoings/destroy', [OutgoingsController::class, 'destroy'])->name('outgoings.destroy');

    // Settings
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');

    // Categories
    Route::post('/categories/store', [CategoriesController::class, 'store'])->name('categories.store');
    Route::post('/categories/destroy', [CategoriesController::class, 'destroy'])->name('categories.destroy');

    // Currencies
    Route::post('/currencies/store', [CurrenciesController::class, 'store'])->name('currencies.store');
    Route::post('/currencies/destroy', [CurrenciesController::class, 'destroy'])->name('currencies.destroy');

    // Payment types
    Route::post('/payment-type/store', [PaymentTypesController::class, 'store'])->name('payment-type.store');
    Route::post('/payment-type/destroy', [PaymentTypesController::class, 'destroy'])->name('payment-type.destroy');
});

