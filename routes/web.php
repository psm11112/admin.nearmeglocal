<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\CategoryController;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/demo',[\App\Http\Controllers\DemoController::class,'index'])->name('index');



Route::controller(\App\Http\Controllers\CategoryController::class)->group(function () {

    Route::get('/category','index')->name('category.index');
    Route::post('/category/store','store')->name('category.store');
    Route::get('/category/create','create')->name('category.create');
    Route::post('/category/deleted','itemDeleted')->name('category.deleted');
    Route::post('/category/change-status','changeStatus')->name('category.change-status');
    Route::get('/category/{id}','edit')->name('category.edit');
    Route::post('/category/delete-image','deleteImage')->name('category.delete-image');
    Route::post('/category/update','update')->name('category.update');


})->middleware(['auth', 'verified']);

Route::controller(\App\Http\Controllers\SubCategoryController::class)->group(function () {

    Route::get('/sub-category','index')->name('sub-category.index');
    Route::post('/sub-category/store','store')->name('sub-category.store');
    Route::get('/sub-category/create','create')->name('sub-category.create');
    Route::post('/sub-category/deleted','itemDeleted')->name('sub-category.deleted');
    Route::post('/sub-category/change-status','changeStatus')->name('sub-category.change-status');
    Route::get('/sub-category/{id}','edit')->name('sub-category.edit');
    Route::post('/sub-category/delete-image','deleteImage')->name('sub-category.delete-image');
    Route::post('/sub-category/update','update')->name('sub-category.update');
    Route::post('sub-category/add','addSubCategory')->name('sub-category.add');
    Route::post('sub-category/remove','removeSubCategoryFromParent')->name('sub-category.remove');


})->middleware(['auth', 'verified']);

Route::controller(\App\Http\Controllers\Admin\CountryController::class)->group(function () {

    Route::post('/country/update','update')->name('country.update');
    Route::get('/country','index')->name('country.index');
    Route::get('/country/create','create')->name('country.create');
    Route::get('/country/{id}','edit')->name('country.edit');
    Route::post('/country/deleted','itemDeleted')->name('country.deleted');

    Route::post('/country/store','store')->name('country.store');
    Route::post('/country/change-status','changeStatus')->name('country.change-status');
})->middleware(['auth', 'verified']);

Route::controller(\App\Http\Controllers\StatesController::class)->group(function () {
    Route::get('/state/create','create')->name('state.create');
    Route::get('/state/{id}','edit')->name('state.edit');
    Route::get('/state','index')->name('state.index');

    Route::post('/state/store','store')->name('state.store');
    Route::post('/state/change-status','changeStatus')->name('state.change-status');
    Route::post('/state/deleted','itemDeleted')->name('state.deleted');
    Route::post('/state/update','update')->name('state.update');



});

Route::controller(\App\Http\Controllers\UserController::class)->group(function () {
    Route::get('/user','index')->name('user.index');
    Route::get('/user/{id}','edit')->name('user.edit');
    Route::post('/user/update','update')->name('user.update');
    Route::post('/user/change-status','changeStatus')->name('user.change-status');
    Route::post('/user/deleted','itemDeleted')->name('user.delete');



});

Route::controller(\App\Http\Controllers\ListController::class)->group(function () {
    Route::get('/list','index')->name('list.index');
    Route::get('/list/create','create')->name('list.create');




});


Route::controller(\App\Http\Controllers\SettingController::class)->group(function () {
    Route::get('/setting','index')->name('setting.index');
    Route::post('setting/store','store')->name('setting.store');




});


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get("/admin-login",[\App\Http\Controllers\DashbordController::class,'loginDirect'])->name('admin.dashbord');


require __DIR__.'/auth.php';
