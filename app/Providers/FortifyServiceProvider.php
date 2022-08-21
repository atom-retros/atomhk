<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\HousekeepingPermission;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::authenticateUsing(function (Request $request) {
            $user = User::query()->where('username', $request->input('username'))->first();

            if (is_null($user)) {
                throw ValidationException::withMessages([
                    Fortify::username() => __('These credentials do not match our records.'),
                ]);
            }

            if (! hasPermission($user,'can_login')) {
                throw ValidationException::withMessages([
                    Fortify::username() => __('You are not eligible to login to the housekeeping.'),
                ]);
            }

            if ($user &&
                Hash::check($request->input('password'), $user->password)) {
                return $user;
            }
        });

    }
}
