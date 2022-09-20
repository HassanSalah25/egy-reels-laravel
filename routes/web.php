<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
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
});
Route::prefix('google')->name('google.')->group( function(){
    Route::get('login', [GoogleController::class, 'loginWithGoogle'])->name('login');
    Route::get('logout', [GoogleController::class, 'logoutFromGoogle'])->name('logout');
    Route::any('callback', [GoogleController::class, 'callbackFromGoogle'])->name('callback');
});