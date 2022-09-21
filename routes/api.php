<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



//all routes / api here must be api authenticated
Route::group(['middleware' => ['api'], 'namespace' => 'Api'], function () {





        Route::group(['prefix' => 'admin'],function () {
            Route::post('show', [\App\Http\Controllers\API\UserController::class, 'show']);
            Route::post('store', [\App\Http\Controllers\API\UserController::class, 'store']);
            Route::post('update', [\App\Http\Controllers\API\UserController::class, 'update']);
            Route::post('destroy', [\App\Http\Controllers\API\UserController::class, 'destroy']);
        });


        Route::group(['prefix' => 'reel'],function () {

            Route::post('show', [\App\Http\Controllers\ReelController::class, 'show']);
            Route::post('store', [\App\Http\Controllers\ReelController::class, 'store']);
            Route::post('update', [\App\Http\Controllers\ReelController::class, 'update']);
            Route::post('destroy', [\App\Http\Controllers\ReelController::class, 'destroy']);
        });





    });

