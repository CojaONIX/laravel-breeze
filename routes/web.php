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
Route::middleware('auth')->group(function () {
    Route::get('/admin/forecast/all', [ForecastController::class, 'getAllForecasts'])->name('admin.forecast.all.page');
    Route::get('/admin/forecast/add', [ForecastController::class, 'addForecastPage'])->name('admin.forecast.add.page');
    Route::post('/admin/forecast/add', [ForecastController::class, 'createForecast'])->name('admin.forecast.create');
    Route::get('/admin/forecast/edit/{forecast}', [ForecastController::class, 'editForecastPage'])->name('admin.forecast.edit.page');
    Route::put('/admin/forecast/edit/{forecast}', [ForecastController::class, 'updateForecast'])->name('admin.forecast.update');
    Route::delete('/admin/forecast/delete/{forecast}', [ForecastController::class, 'deleteForecast'])->name('admin.forecast.delete');
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
