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


Route::post('/login', [\App\Http\Controllers\API\AuthController::class, 'login'])->name('login')->middleware('cors');
Route::post('/register', [\App\Http\Controllers\API\AuthController::class, 'register'])->name('register')->middleware('cors');;
Route::post('/opt_verification', [\App\Http\Controllers\API\AuthController::class, 'opt_verification'])->name('opt_verification')->middleware('cors');;

Route::post('/logout',[\App\Http\Controllers\API\AuthController::class,'logout'])->name('logout');
Route::get('/me', [\App\Http\Controllers\API\AuthController::class, 'me'])->name('me')->middleware('auth:sanctum');
Route::get('/user/view/{id}', [\App\Http\Controllers\API\CommonController::class, 'getUser'])->name('user-view');
Route::get('/country/view/{id}', [\App\Http\Controllers\API\CommonController::class, 'getCountry'])->name('country-view');
Route::get('/state/view/{id}', [\App\Http\Controllers\API\CommonController::class, 'getStates'])->name('state-view');
Route::get('/category/view/{id}', [\App\Http\Controllers\API\CommonController::class, 'getCategory'])->name('category-view');
Route::get('/sub-category/view/{id}', [\App\Http\Controllers\API\CommonController::class, 'getSubCategory'])->name('sub-category-view');
Route::post('/sub-category', [\App\Http\Controllers\API\CommonController::class, 'getSubCategoryByCategory'])->name('sub-category');
Route::get('/sub-category/all', [\App\Http\Controllers\API\CommonController::class, 'getAllSubCategory'])->name('sub-category.all');



