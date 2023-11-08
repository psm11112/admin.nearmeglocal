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


Route::post('/login', [\App\Http\Controllers\API\AuthController::class, 'login'])->name('login');
Route::post('/register', [\App\Http\Controllers\API\AuthController::class, 'register'])->name('register');
Route::post('/opt_verification', [\App\Http\Controllers\API\AuthController::class, 'opt_verification'])->name('opt_verification');

Route::post('/logout',[\App\Http\Controllers\API\AuthController::class,'logout'])->name('logout');
Route::get('/me', [\App\Http\Controllers\API\AuthController::class, 'me'])->name('me')->middleware('auth:sanctum');
Route::get('/user/view/{id}', [\App\Http\Controllers\API\CommonController::class, 'getUser'])->name('user-view');
Route::get('/country/view/{id}', [\App\Http\Controllers\API\CommonController::class, 'getCountry'])->name('country-view');
Route::get('/state/view/{id}', [\App\Http\Controllers\API\CommonController::class, 'getStates'])->name('state-view');
