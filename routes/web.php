<?php

use App\Http\Controllers\CuisineController;
use App\Http\Controllers\IncludesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequirementController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\LanguageController;
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

        Route::prefix('/tag')->name('tag.')->group(function () {
            Route::get('/', [TagController::class, 'index'])->name('list');
            Route::get('/create', [TagController::class, 'create'])->name('create');
            Route::post('/', [TagController::class, 'store'])->name('store');
            Route::get('/{id}', [TagController::class, 'show'])->name('show');
            Route::post('/{id}', [TagController::class, 'update'])->name('update');
            Route::delete('/{id}', [TagController::class, 'destroy'])->name('destroy');
            Route::get('/{id}/reactivate', [TagController::class, 'reactivate'])->name('reactivate');
        });

        Route::prefix('/requirement')->name('requirement.')->group(function () {
            Route::get('/', [RequirementController::class, 'index'])->name('list');
            Route::get('/create', [RequirementController::class, 'create'])->name('create');
            Route::post('/', [RequirementController::class, 'store'])->name('store');
            Route::get('/{id}', [RequirementController::class, 'show'])->name('show');
            Route::post('/{id}', [RequirementController::class, 'update'])->name('update');
            Route::delete('/{id}', [RequirementController::class, 'destroy'])->name('destroy');
            Route::get('/{id}/reactivate', [RequirementController::class, 'reactivate'])->name('reactivate');
        });

        Route::prefix('/language')->name('language.')->group(function () {
            Route::get('/', [LanguageController::class, 'index'])->name('list');
            Route::get('/create', [LanguageController::class, 'create'])->name('create');
            Route::post('/', [LanguageController::class, 'store'])->name('store');
            Route::get('/{id}', [LanguageController::class, 'show'])->name('show');
            Route::post('/{id}', [LanguageController::class, 'update'])->name('update');
            Route::delete('/{id}', [LanguageController::class, 'destroy'])->name('destroy');
            Route::get('/{id}/reactivate', [LanguageController::class, 'reactivate'])->name('reactivate');
        });
    });

require __DIR__ . '/auth.php';