<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BansController;
use App\Http\Controllers\CatalogItemController;
use App\Http\Controllers\CatalogPagesController;
use App\Http\Controllers\CatalogPageSearchController;
use App\Http\Controllers\ChatlogsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmulatorSettingsController;
use App\Http\Controllers\EmulatorTextsController;
use App\Http\Controllers\PrivateChatlogsController;
use App\Http\Controllers\StaffApplicationsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPasswordController;
use App\Http\Controllers\WebsiteIpBlacklistsController;
use App\Http\Controllers\WebsiteIpWhitelistsController;
use App\Http\Controllers\WebsiteSettingsController;
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

        Route::get('/{user}/edit/password', [UserPasswordController::class, 'edit'])->name('users.password.edit');
        Route::put('/{user}/edit/password', [UserPasswordController::class, 'update'])->name('users.password.update');
    });

    Route::prefix('staff-applications')->group(function () {
        Route::get('/', [StaffApplicationsController::class, 'index'])->name('staff-applications.index');
        Route::get('/{application}', [StaffApplicationsController::class, 'show'])->name('staff-applications.show');
        Route::put('/{application}/accept', [StaffApplicationsController::class, 'accept'])->name('staff-applications.accept');
        Route::put('/{application}/reject', [StaffApplicationsController::class, 'reject'])->name('staff-applications.reject');
        Route::put('/{application}/reset', [StaffApplicationsController::class, 'reset'])->name('staff-applications.reset');
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
        Route::post('/update/rcon', [WordfilterController::class, 'updateFilterRcon'])->name('wordfilter.update-rcon');
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

        // Catalog items
        Route::get('/items/{item}', [CatalogItemController::class, 'edit'])->name('catalog-pages.items.edit');

        // Page search
        Route::get('/search', [CatalogPageSearchController::class, 'search'])->name('catalog-page.search');

        // Update through rcon
        Route::post('/update', [CatalogPagesController::class, 'updateRcon'])->name('catalog-pages.rcon-update');
    });

    // Settings routes
    Route::prefix('settings')->group(function () {
        Route::get('/emulator', [EmulatorSettingsController::class, 'index'])->name('emulator-settings.index');
        Route::get('/emulator/create', [EmulatorSettingsController::class, 'create'])->name('emulator-settings.create');
        Route::post('/emulator/create', [EmulatorSettingsController::class, 'store'])->name('emulator-settings.store');
        Route::get('/emulator/search', [EmulatorSettingsController::class, 'search'])->name('emulator-settings.search');
        Route::get('/emulator/update/rcon', [EmulatorSettingsController::class, 'updateRcon'])->name('emulator-settings.update.rcon');
        Route::get('/emulator/{setting}/edit', [EmulatorSettingsController::class, 'edit'])->name('emulator-settings.edit');
        Route::put('/emulator/{setting}/edit', [EmulatorSettingsController::class, 'update'])->name('emulator-settings.update');
        Route::delete('/emulator/{setting}/delete', [EmulatorSettingsController::class, 'destroy'])->name('emulator-settings.delete');
    });

    // Emulator routes
    Route::prefix('emulator')->group(function () {
        Route::get('/texts', [EmulatorTextsController::class, 'index'])->name('emulator-texts.index');
        Route::get('/texts/create', [EmulatorTextsController::class, 'create'])->name('emulator-texts.create');
        Route::post('/texts/create', [EmulatorTextsController::class, 'store'])->name('emulator-texts.store');
        Route::get('/texts/search', [EmulatorTextsController::class, 'search'])->name('emulator-texts.search');
        Route::post('/texts/update/rcon', [EmulatorTextsController::class, 'updateEmulatorTextsRcon'])->name('emulator-texts.update.rcon');
        Route::get('/texts/{text}/edit', [EmulatorTextsController::class, 'edit'])->name('emulator-texts.edit');
        Route::put('/texts/{text}/edit', [EmulatorTextsController::class, 'update'])->name('emulator-texts.update');
        Route::delete('/texts/{text}/delete', [EmulatorTextsController::class, 'destroy'])->name('emulator-texts.delete');
    });

    // Website routes
    Route::prefix('website')->group(function () {
        Route::prefix('settings')->group(function () {
            Route::get('/', [WebsiteSettingsController::class, 'index'])->name('website-settings.index');
            Route::get('/create', [WebsiteSettingsController::class, 'create'])->name('website-settings.create');
            Route::post('/create', [WebsiteSettingsController::class, 'store'])->name('website-settings.store');
            Route::get('/search', [WebsiteSettingsController::class, 'search'])->name('website-settings.search');
            Route::get('/{websiteSetting}/edit', [WebsiteSettingsController::class, 'edit'])->name('website-settings.edit');
            Route::put('/{websiteSetting}/edit', [WebsiteSettingsController::class, 'update'])->name('website-settings.update');
            Route::delete('/{websiteSetting}/delete', [WebsiteSettingsController::class, 'destroy'])->name('website-settings.destroy');
        });

        Route::prefix('ip-whitelist')->group(function () {
            Route::get('/', [WebsiteIpWhitelistsController::class, 'index'])->name('website-whitelist.index');
            Route::get('/create', [WebsiteIpWhitelistsController::class, 'create'])->name('website-whitelist.create');
            Route::post('/create', [WebsiteIpWhitelistsController::class, 'store'])->name('website-whitelist.store');
            Route::get('/search', [WebsiteIpWhitelistsController::class, 'search'])->name('website-whitelist.search');
            Route::get('/{websiteIpWhitelist}/edit', [WebsiteIpWhitelistsController::class, 'edit'])->name('website-whitelist.edit');
            Route::put('/{websiteIpWhitelist}/edit', [WebsiteIpWhitelistsController::class, 'update'])->name('website-whitelist.update');
            Route::delete('/{websiteIpWhitelist}/delete', [WebsiteIpWhitelistsController::class, 'destroy'])->name('website-whitelist.destroy');
        });

        Route::prefix('ip-blacklist')->group(function () {
            Route::get('/', [WebsiteIpBlacklistsController::class, 'index'])->name('website-blacklist.index');
            Route::get('/create', [WebsiteIpBlacklistsController::class, 'create'])->name('website-blacklist.create');
            Route::post('/create', [WebsiteIpBlacklistsController::class, 'store'])->name('website-blacklist.store');
            Route::get('/search', [WebsiteIpBlacklistsController::class, 'search'])->name('website-blacklist.search');
            Route::get('/{websiteIpBlacklist}/edit', [WebsiteIpBlacklistsController::class, 'edit'])->name('website-blacklist.edit');
            Route::put('/{websiteIpBlacklist}/edit', [WebsiteIpBlacklistsController::class, 'update'])->name('website-blacklist.update');
            Route::delete('/{websiteIpBlacklist}/delete', [WebsiteIpBlacklistsController::class, 'destroy'])->name('website-blacklist.destroy');
        });
        Route::prefix('miscellaneous')->group(function () {
            Route::get('/activity-logs', ActivityLogController::class)->name('activity-logs.index');
        });
    });
});
