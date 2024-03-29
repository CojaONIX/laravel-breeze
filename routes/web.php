<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ForecastController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'home')->name('home.page');
Route::view('/about', 'about')->name('about.page');
Route::view('/welcome', 'welcome')->name('welcome.page');

Route::get('/forecast', [ForecastController::class, 'index'])->middleware('auth')->name('forecast.page');
Route::get('/forecast/{city}', [ForecastController::class, 'getCityForecast'])->name('forecast.city.page');


Route::middleware(['auth', 'isAdmin'])->prefix('/admin')->name('admin.')->group(function () {
    Route::controller(ForecastController::class)->prefix('/forecast')->name('forecast.')->group(function () {
        Route::get('/all', 'getAllForecasts')->name('all.page');
        Route::get('/add', 'addForecastPage')->name('add.page');
        Route::post('/add', 'createForecast')->name('create');
        Route::get('/edit/{forecast}', 'editForecastPage')->name('edit.page');
        Route::put('/edit/{forecast}', 'updateForecast')->name('update');
        Route::delete('/delete/{forecast}', 'deleteForecast')->name('delete');
    });
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
