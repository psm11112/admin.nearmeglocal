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
Route::get('/area/view/{id}', [\App\Http\Controllers\API\CommonController::class, 'getArea'])->name('area-view');

Route::post('/sub-category', [\App\Http\Controllers\API\CommonController::class, 'getSubCategoryByCategory'])->name('sub-category');
Route::get('/sub-category/all', [\App\Http\Controllers\API\CommonController::class, 'getAllSubCategory'])->name('sub-category.all');
Route::get('/states/all', [\App\Http\Controllers\API\CommonController::class, 'getAllStates'])->name('states.all');
Route::get('/cities/all', [\App\Http\Controllers\API\CommonController::class, 'getAllCity'])->name('cites.all');
Route::get('/cities/view/{id}', [\App\Http\Controllers\API\CommonController::class, 'getCity'])->name('cites-view');

Route::get('/slug/{name}', [\App\Http\Controllers\API\CommonController::class, 'getSlug'])->name('slug');

Route::get('/stats/{country_id}', [\App\Http\Controllers\API\CommonController::class, 'getStatsByCountryId'])->name('country.stats');
Route::get('/city/{stats_id}', [\App\Http\Controllers\API\CommonController::class, 'getCityByStatsId'])->name('stats.city');
Route::get('/area/{city_id}', [\App\Http\Controllers\API\CommonController::class, 'getAreaByCityId'])->name('city.area');
Route::post('/upload', [\App\Http\Controllers\API\CommonController::class, 'upload']);

Route::get('/list/view/{id}', [\App\Http\Controllers\API\CommonController::class, 'getList'])->name('list-view');
Route::get('/encrypt-value/{id}', [\App\Http\Controllers\API\CommonController::class, 'getEncryptString'])->name('encrypt-value');


Route::get('/list', [\App\Http\Controllers\API\ListController::class, 'index'])->name('list.index');

Route::get('/category', [\App\Http\Controllers\API\CategoryController::class, 'index'])->name('category.index');




