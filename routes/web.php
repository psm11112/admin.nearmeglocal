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

Route::post('/category/create',[CategoryController::class,'store'])->name('category.store');
Route::get('/category',[CategoryController::class,'index'])->name('category');



Route::controller(\App\Http\Controllers\Admin\CountryController::class)->group(function () {
    Route::get('/orders/{id}', 'show');
    Route::post('/orders', 'store');
    Route::get('/country','index')->name('country.index');
    Route::post('/country/deleted','itemDeleted')->name('country.deleted');
    Route::get('/country/create','create')->name('country.create');
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


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
