<?php

use App\Http\Controllers\Api\Category\CategoryGatewayController;
use App\Http\Controllers\Api\CustomerInformation\CustomerInformationGatewayController;
use App\Http\Controllers\Api\PaymentMethod\PaymentMethodGatewayController;
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

Route::group(['as' => 'api.'], function () {
    // Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    //     return $request->user();

    // })->name('user');

    Route::lapiv(function () {
        // CUSTOMER INFORMATION
        Route::group(['prefix' => 'customer-information', 'as' => 'customer-information.', 'controller' => CustomerInformationGatewayController::class], function () {
            Route::get('/', 'getList')->name('getList');
            Route::get('{id}', 'getDetail')->name('getDetail');
            Route::post('/{id}/update', 'updateDetail')->name('updateDetail');
            Route::delete('/{id}/delete', 'deleteCustomer')->name('deleteCustomer');
        });

        // CATEGORY
        Route::group(['prefix' => 'categories', 'as' => 'categories.', 'controller' => CategoryGatewayController::class], function () {
            Route::get('/', 'getList')->name('getList');
            Route::get('/{slug}', 'getDetail')->name('getDetail');
            Route::post('/{id}/update', 'updateDetail')->name('updateDetail');
            Route::delete('/{id}/delete', 'deleteCategory')->name('deleteCategory');
        });

        // PAYMENT METHOD
        Route::group(['prefix' => 'payment-methods', 'as' => 'payment-methods.', 'controller' => PaymentMethodGatewayController::class], function () {
            Route::get('/', 'getList')->name('getList');
            Route::get('/{id}', 'getDetail')->name('getDetail');
            Route::post('/{id}/update', 'updateDetail')->name('updateDetail');
            Route::delete('/{id}/delete', 'deletePaymentMethod')->name('deletePaymentMethod');
        });
    });
});
