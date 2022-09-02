<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BansController;
use App\Http\Controllers\CatalogPagesController;
use App\Http\Controllers\CatalogPageSearchController;
use App\Http\Controllers\ChatlogsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmulatorSettingsController;
use App\Http\Controllers\PrivateChatlogsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WordfilterController;
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
        Route::get('/search', [UserController::class, 'search'])->name('users.search');
        Route::post('/{user}/clones', [UserController::class, 'clones'])->name('users.clones');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/{user}/edit', [UserController::class, 'update'])->name('users.update');
        Route::delete('/{user}/delete', [UserController::class, 'destroy'])->name('user.destroy');
    });

    // Article management
    Route::prefix('articles')->group(function () {
        Route::get('/', [ArticleController::class, 'index'])->name('articles.index');
        Route::get('/create', [ArticleController::class, 'create'])->name('articles.create');
        Route::post('/create', [ArticleController::class, 'store'])->name('articles.store');
        Route::get('/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
        Route::put('/{article}/edit', [ArticleController::class, 'update'])->name('articles.update');
        Route::delete('/{article}/delete', [ArticleController::class, 'destroy'])->name('articles.destroy');
    });

    // Wordfilter management
    Route::prefix('wordfilter')->group(function () {
        Route::get('/', [WordfilterController::class, 'index'])->name('wordfilter.index');
        Route::get('/create', [WordfilterController::class, 'create'])->name('wordfilter.create');
        Route::post('/create', [WordfilterController::class, 'store'])->name('wordfilter.store');
        Route::get('/{key}/edit', [WordfilterController::class, 'edit'])->name('wordfilter.edit');
        Route::put('/{key}/edit', [WordfilterController::class, 'update'])->name('wordfilter.update');
        Route::delete('/{key}/delete', [WordfilterController::class, 'destroy'])->name('wordfilter.destroy');
    });

    // Ban management
    Route::prefix('bans')->group(function () {
        Route::get('/', [BansController::class, 'index'])->name('bans.index');
        Route::delete('/{ban}/delete', [BansController::class, 'destroy'])->name('bans.destroy');
    });

    // Chatlogs
    Route::prefix('chatlogs')->group(function () {
        Route::get('/', [ChatlogsController::class, 'index'])->name('chatlogs.room');
        Route::get('/filter', [ChatlogsController::class, 'search'])->name('chatlogs.filter');

        Route::get('/private', [PrivateChatlogsController::class, 'index'])->name('chatlogs.private');
        Route::get('/private/filter', [PrivateChatlogsController::class, 'search'])->name('chatlogs.private.filter');
    });

    // Catalog routes
    Route::prefix('catalog')->group(function () {
        Route::get('/pages', [CatalogPagesController::class, 'index'])->name('catalog-pages.index');
        Route::get('/pages/create', [CatalogPagesController::class, 'create'])->name('catalog-pages.create');
        Route::post('/pages/create', [CatalogPagesController::class, 'store'])->name('catalog-pages.store');
        Route::get('/pages/{catalogPage}/edit', [CatalogPagesController::class, 'edit'])->name('catalog-pages.edit');
        Route::put('/pages/{catalogPage}/edit', [CatalogPagesController::class, 'update'])->name('catalog-pages.update');
        Route::delete('/pages/{catalogPage}/delete', [CatalogPagesController::class, 'destroy'])->name('catalog-pages.delete');

        // Page search
        Route::get('/search', [CatalogPageSearchController::class, 'search'])->name('catalog-page.search');
    });

    // Settings routes
    Route::prefix('settings')->group(function () {
        Route::get('/emulator', [EmulatorSettingsController::class, 'index'])->name('emulator-settings.index');
        Route::get('/emulator/create', [EmulatorSettingsController::class, 'create'])->name('emulator-settings.create');
        Route::post('/emulator/create', [EmulatorSettingsController::class, 'store'])->name('emulator-settings.store');
        Route::get('/emulator/{setting}/edit', [EmulatorSettingsController::class, 'edit'])->name('emulator-settings.edit');
        Route::put('/emulator/{setting}/edit', [EmulatorSettingsController::class, 'update'])->name('emulator-settings.update');
        Route::delete('/emulator/{setting}/delete', [EmulatorSettingsController::class, 'destroy'])->name('emulator-settings.delete');
    });
});
