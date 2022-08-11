<?php

use App\Http\Controllers\WebsiteArticlesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    })->name('login');

    Route::get('/login', function () {
        return view('auth.login');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    // User management
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/{user}/edit', [UserController::class, 'update'])->name('users.update');
        Route::delete('/{user}/delete', [UserController::class, 'destroy'])->name('user.destroy');
    });

    Route::prefix('articles')->group(function () {
        Route::get('/', [WebsiteArticlesController::class, 'index'])->name('articles.index');
        Route::get('/create', [WebsiteArticlesController::class, 'create'])->name('articles.create');
        Route::post('/create', [WebsiteArticlesController::class, 'store'])->name('articles.store');
        Route::get('/{article:slug}/edit', [WebsiteArticlesController::class, 'edit'])->name('articles.edit');
        Route::put('/{article:slug}/edit', [WebsiteArticlesController::class, 'update'])->name('articles.update');
        Route::delete('/{article:slug}/delete', [WebsiteArticlesController::class, 'destroy'])->name('articles.destroy');
    });
});