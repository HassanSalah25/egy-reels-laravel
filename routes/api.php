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
Route::group(['middleware' => ['api-jwt'], 'namespace' => 'Api'], function () {


        Route::post('login', [AuthController::class,'login']);


        Route::group(['prefix' => 'admin'],function () {

            Route::post('show', [\App\Http\Controllers\API\UserController::class, 'show'])-> middleware(['auth.guard:admin-api']);
            Route::post('store', [\App\Http\Controllers\API\UserController::class, 'store'])-> middleware(['auth.guard:admin-api']);
            Route::post('update', [\App\Http\Controllers\API\UserController::class, 'update'])-> middleware(['auth.guard:admin-api']);
            Route::post('destroy', [\App\Http\Controllers\API\UserController::class, 'destroy'])-> middleware(['auth.guard:admin-api']);
        });


        Route::group(['prefix' => 'reel'],function () {

            Route::post('show', [\App\Http\Controllers\ReelController::class, 'show'])-> middleware(['auth.guard:admin-api']);
            Route::post('store', [\App\Http\Controllers\ReelController::class, 'store'])-> middleware(['auth.guard:admin-api']);
            Route::post('update', [\App\Http\Controllers\ReelController::class, 'update'])-> middleware(['auth.guard:admin-api']);
            Route::post('destroy', [\App\Http\Controllers\ReelController::class, 'destroy'])-> middleware(['auth.guard:admin-api']);
        });


        Route::group(['prefix' => 'user'],function () {

            Route::post('show', [\App\Http\Controllers\API\UserController::class, 'show']);
            Route::post('store', [\App\Http\Controllers\API\UserController::class, 'store']);
            Route::post('update', [\App\Http\Controllers\API\UserController::class, 'update']);
            Route::post('destroy', [\App\Http\Controllers\API\UserController::class, 'destroy']);
        });




    });

