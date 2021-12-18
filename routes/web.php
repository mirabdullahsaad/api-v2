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

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('v1')->group(function () {
    Route::post('signup', [App\Http\Controllers\v1\AuthController::class, 'signup']);
    Route::post('signin', [App\Http\Controllers\v1\AuthController::class, 'signin']);

    Route::middleware('auth:api')->get('get-user', [App\Http\Controllers\v1\AuthController::class, 'get_user']);
    Route::middleware('auth:api')->get('get-user-data', [App\Http\Controllers\v1\DataController::class, 'get_user_data']);
});

Route::get('/broadcast', [App\Http\Controllers\v1\DataController::class, 'broadcast']);
Route::get('/listen', function () {
    return view('listen');
});
