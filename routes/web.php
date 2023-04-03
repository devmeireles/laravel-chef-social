<?php

use App\Http\Controllers\CuisineController;
use App\Http\Controllers\IncludesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->name('admin.')
    ->prefix('admin')->group(function () {
        Route::prefix('/cuisine')->name('cuisine.')->group(function () {
            Route::get('/', [CuisineController::class, 'index'])->name('list');
            Route::get('/create', [CuisineController::class, 'create'])->name('create');
            Route::post('/', [CuisineController::class, 'store'])->name('store');
            Route::get('/{id}', [CuisineController::class, 'show'])->name('show');
            Route::post('/{id}', [CuisineController::class, 'update'])->name('update');
            Route::delete('/{id}', [CuisineController::class, 'destroy'])->name('destroy');
            Route::get('/{id}/reactivate', [CuisineController::class, 'reactivate'])->name('reactivate');
        });

        Route::prefix('/includes')->name('includes.')->group(function () {
            Route::get('/', [IncludesController::class, 'index'])->name('list');
            Route::get('/create', [IncludesController::class, 'create'])->name('create');
            Route::post('/', [IncludesController::class, 'store'])->name('store');
            Route::get('/{id}', [IncludesController::class, 'show'])->name('show');
            Route::post('/{id}', [IncludesController::class, 'update'])->name('update');
            Route::delete('/{id}', [IncludesController::class, 'destroy'])->name('destroy');
            Route::get('/{id}/reactivate', [IncludesController::class, 'reactivate'])->name('reactivate');
        });
    });

require __DIR__ . '/auth.php';