<?php

use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\CurrenciesController;
use App\Http\Controllers\Api\PaymentTypesController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\IncomingsController;
use App\Http\Controllers\Api\OutgoingsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [LoginController::class, 'login']);

// Incoming
Route::get('incoming', [IncomingsController::class, 'incoming']);
Route::get('incoming/{id}', [IncomingsController::class, 'getIncomingById']);
Route::post('incoming', [IncomingsController::class, 'saveIncoming']);
Route::delete('incoming/{id}', [IncomingsController::class, 'deleteIncoming']);

// Category
Route::get('category', [CategoriesController::class, 'category']);
Route::get('category/{id}', [CategoriesController::class, 'getCategoryById']);
Route::post('category', [CategoriesController::class, 'saveCategory']);
Route::delete('category/{id}', [CategoriesController::class, 'deleteCategory']);

// Currency
Route::get('currency', [CurrenciesController::class, 'currency']);
Route::get('currency/{id}', [CurrenciesController::class, 'getCurrencyById']);
Route::post('currency', [CurrenciesController::class, 'saveCurrency']);
Route::delete('currency/{id}', [CurrenciesController::class, 'deleteCurrency']);

// Payment Method
Route::get('payment-method', [PaymentTypesController::class, 'paymentType']);
Route::get('payment-method/{id}', [PaymentTypesController::class, 'getPaymentTypeById']);
Route::post('payment-method', [PaymentTypesController::class, 'savePaymentType']);
Route::delete('payment-method/{id}', [PaymentTypesController::class, 'deletePaymentType']);

// Outgoing
Route::get('outgoing', [OutgoingsController::class, 'outgoing']);
Route::get('outgoing/{id}', [OutgoingsController::class, 'getOutgoingById']);
Route::post('outgoing', [OutgoingsController::class, 'saveOutgoing']);
Route::delete('outgoing/{id}', [OutgoingsController::class, 'deleteOutgoing']);

Route::group(['middleware' => ['jwt.verify']], function() {

    // Token refresh
    Route::get('refresh', [LoginController::class, 'refresh']);
});
