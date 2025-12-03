<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Http\Responses\PasswordConfirmedResponse;
use Laravel\Fortify\Contracts\PasswordConfirmedResponse as PasswordConfirmedResponseContract;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Responses\PasswordConfirmationViewResponse;
use Laravel\Fortify\Contracts\ConfirmPasswordViewResponse as ConfirmPasswordViewResponseContract;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        // Désactivé pour permettre TA redirection QR
        // Fortify::redirectUserForTwoFactorAuthenticationUsing(RedirectIfTwoFactorAuthenticatable::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());
            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        // Activation de la 2FA avec la vue personnalisée
        Fortify::twoFactorChallengeView(function () {
            return view('auth.two-factor-challenge');
        });

        // Redirection après authentification 2FA réussie
        Fortify::twoFactorChallengeResponse(function ($request) {
            return redirect()->intended('/dashboard');
        });

        // AUTH PERSONNALISÉE
        Fortify::authenticateUsing(function ($request) {
            $user = User::where('email', $request->email)->first();

            if ($user && Hash::check($request->password, $user->password)) {
                return $user;
            }
        });

        // REDIRECTION APRÈS LOGIN
        Fortify::loginResponse(function ($request) {
            $user = $request->user();

            // Si l'utilisateur a activé la 2FA
            if ($user->two_factor_secret) {
                // Déconnecter temporairement pour forcer l'OTP
                auth()->logout();

                // Stocker l'ID en session
                $request->session()->put('login.id', $user->id);

                // Rediriger vers le challenge OTP
                return redirect()->route('two-factor.login');
            }

            // Sinon redirection normale
            return redirect()->intended(route('dashboard'));
        });

        $this->app->singleton(ConfirmPasswordViewResponseContract::class, PasswordConfirmationViewResponse::class);
        $this->app->singleton(PasswordConfirmedResponseContract::class, PasswordConfirmedResponse::class); 
    }
}
