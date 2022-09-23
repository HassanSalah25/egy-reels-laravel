<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Auth\AuthController;
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
Route::post('login', [AuthController::class,'login']);
Route::post('logout', [AuthController::class,'logout']);
Auth::routes(['verify' => true]);


Route::group(['middleware' => ['api','auth.guard:admin-api'], 'namespace' => 'Api'], function () {

        Route::group(['prefix' => 'admin'],function () {
            Route::post('show', [\App\Http\Controllers\API\UserController::class, 'show']);
            Route::get('store', [\App\Http\Controllers\API\UserController::class, 'store']);
            Route::post('update', [\App\Http\Controllers\API\UserController::class, 'update']);
            Route::post('destroy', [\App\Http\Controllers\API\UserController::class, 'destroy']);
        });


        Route::group(['prefix' => 'reel'],function () {

            Route::post('show', [\App\Http\Controllers\API\ReelController::class, 'show']);
            Route::post('store', [\App\Http\Controllers\API\ReelController::class, 'store']);
            Route::post('update', [\App\Http\Controllers\API\ReelController::class, 'update']);
            Route::post('destroy', [\App\Http\Controllers\API\ReelController::class, 'destroy']);
        });



    Route::group(['prefix' => 'comment'],function () {
        Route::post('show', [\App\Http\Controllers\API\UserController::class, 'showComments']);
        Route::post('store', [\App\Http\Controllers\API\UserController::class, 'createComment']);
        Route::post('update', [\App\Http\Controllers\API\UserController::class, 'updateComment']);
        Route::post('destroy', [\App\Http\Controllers\API\UserController::class, 'destroyComment']);
    });

    Route::group(['prefix' => 'like'],function () {
        Route::post('show', [\App\Http\Controllers\API\UserController::class, 'showLikes']);
        Route::post('store', [\App\Http\Controllers\API\UserController::class, 'like']);
        Route::post('destroy', [\App\Http\Controllers\API\UserController::class, 'unlike']);
    });

    Route::group(['prefix' => 'Following'],function () {
        Route::post('show', [\App\Http\Controllers\API\UserController::class, 'showFollowings']);
        Route::post('store', [\App\Http\Controllers\API\UserController::class, 'followUser']);
        Route::post('destroy', [\App\Http\Controllers\API\UserController::class, 'removeFollowing']);
    });
    });

Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');

