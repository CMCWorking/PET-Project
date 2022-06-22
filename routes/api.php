<?php

use App\Http\Controllers\Api\CustomerInformation\CustomerInformationAPIController;
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

Route::group(['as' => 'api.'], function () {
    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();

    })->name('user');

    Route::group(['prefix' => 'customer-information', 'as' => 'customer-information.', 'controller' => CustomerInformationAPIController::class], function () {
        Route::get('/', 'getList')->name('getList');
        Route::get('{id}', 'getDetail')->name('getDetail');
        Route::post('/{id}/update', 'updateDetail')->name('updateDetail');
        Route::delete('/{id}/delete', 'deleteCustomer')->name('deleteCustomer');
    });
});
