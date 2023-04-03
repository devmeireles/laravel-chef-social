<?php

use App\Http\Controllers\CuisineController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
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

        Route::prefix('/tag')->name('tag.')->group(function () {
            Route::get('/', [TagController::class, 'index'])->name('list');
            Route::get('/create', [TagController::class, 'create'])->name('create');
            Route::post('/', [TagController::class, 'store'])->name('store');
            Route::get('/{id}', [TagController::class, 'show'])->name('show');
            Route::post('/{id}', [TagController::class, 'update'])->name('update');
            Route::delete('/{id}', [TagController::class, 'destroy'])->name('destroy');
            Route::get('/{id}/reactivate', [TagController::class, 'reactivate'])->name('reactivate');
        });
    });

require __DIR__ . '/auth.php';