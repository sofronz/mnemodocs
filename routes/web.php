<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\Taxonomy\RolesController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin'       => Route::has('login'),
        'canRegister'    => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion'     => PHP_VERSION,
    ]);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::prefix('roles')->name('roles.')->group(function () {
        Route::get('/', [RolesController::class, 'index'])->name('index');
        Route::get('/create', [RolesController::class, 'create'])->name('create');
        Route::post('/', [RolesController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [RolesController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [RolesController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [RolesController::class, 'destroy'])->name('delete');
    });
});

require __DIR__.'/auth.php';
