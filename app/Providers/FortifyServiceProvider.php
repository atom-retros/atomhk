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
        Fortify::twoFactorChallengeView(function () {
            return view('auth.two-factor-challenge');
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)->by($request->input('username').$request->ip());
        });

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

            if (cmsSetting('force_staff_2fa') === '1' && is_null($user->two_factor_secret)) {
                throw ValidationException::withMessages([
                    Fortify::username() => __('You must go to the hotel and enable 2factor authentication before logging into the housekeeping.'),
                ]);
            }

            if ($user &&
                Hash::check($request->input('password'), $user->password)) {

                activity()->causedBy($user)->withProperty('attribute', sprintf('%s has just logged into the housekeeping from IP %s', $user->username, $request->ip()))->log('HK login');

                return $user;
            }
        });

    }
}
