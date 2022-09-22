<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ReelController;
use App\Http\Controllers\API\UserController;
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
            Route::post('/comments/show', [\App\Http\Controllers\API\UserController::class, 'showComments']);
            Route::post('/follows/show', [\App\Http\Controllers\API\UserController::class, 'showFollowings']);
//            Route::post('store', [\App\Http\Controllers\API\UserController::class, 'store']);
            Route::post('save', [\App\Http\Controllers\API\UserController::class, 'save']);
            Route::post('update', [\App\Http\Controllers\API\UserController::class, 'update']);
            Route::post('destroy', [\App\Http\Controllers\API\UserController::class, 'destroy']);
//                showComments
//                showFollowings
//
//                showLikes

        });


        Route::group(['prefix' => 'reel'],function () {

            Route::post('show', [ReelController::class , 'show']);
            Route::post('store', [ReelController::class, 'store']);
            Route::post('update', [ReelController::class, 'update']);
            Route::post('destroy', [ReelController::class, 'destroy']);

        });





    });

