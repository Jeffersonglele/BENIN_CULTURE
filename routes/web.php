<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Google2FA\Google2FA;
use Illuminate\Support\Str;
use Laravel\Fortify\RecoveryCode;
use App\Models\User;
use App\Http\Controllers\front\LangueController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('front.index');
})->name('home');

Route::get('/langue', [LangueController::class, 'index'])->name('langue');

// Dashboard
Route::get('/dashboard', function () {
    $user = auth()->user();

    // Vérifier si 2FA activé mais pas confirmé
    if ($user->two_factor_secret && !$user->two_factor_confirmed_at) {
        return redirect()->route('two-factor.activate');
    }

    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes protégées par auth
Route::middleware('auth')->group(function () {

    // Profil utilisateur
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/user/confirm-password', function () {
        return view('auth.confirm-password');
    })->name('password.confirm');

    /**
     * --------------------------
     * Activation 2FA
     * --------------------------
     */
    // Générer le secret et QR code
    Route::post('/two-factor/enable', function (Request $request) {
        $user = $request->user();

        if (!$user->two_factor_secret) {
            $google2fa = new Google2FA();
            $secret = $google2fa->generateSecretKey();

            $recoveryCodes = [];
            for ($i = 0; $i < 8; $i++) {
                $recoveryCodes[] = \Str::random(10);
            }

            $user->forceFill([
                'two_factor_secret' => encrypt($secret),
                'two_factor_recovery_codes' => encrypt(json_encode($recoveryCodes)),
            ])->save();
        }
        return redirect()->route('two-factor.activate')
            ->with('status', 'La 2FA a été activée. Scannez maintenant le QR code.');
    })->name('two-factor.enable');

    // Page pour activer 2FA / générer QR code
    Route::get('/two-factor', function () {
        $user = Auth::user();

        // Si l'utilisateur a déjà confirmé le 2FA, rediriger vers le dashboard
        if ($user->two_factor_confirmed_at) {
            return redirect()->route('dashboard');
        }

        return view('auth.two-factor');
    })->name('two-factor.activate');

    // Confirmer le code OTP entré par l'utilisateur
    Route::post('/two-factor/confirm', function (Request $request) {
        $request->validate([
            'code' => 'required|digits:6',
        ]);

        $user = $request->user();
        $google2fa = new Google2FA();

        $secret = decrypt($user->two_factor_secret);

        $valid = $google2fa->verifyKey($secret, $request->code);

        if ($valid) {
            $user->two_factor_confirmed_at = now();
            $user->save();

            return redirect()->route('dashboard')
                ->with('status', 'La double authentification a été activée avec succès !');
        }

        return back()->withErrors([
            'code' => 'Le code OTP est invalide.'
        ]);
    })->name('two-factor.confirm');


    // Désactivation 2FA
    Route::post('/two-factor/disable', function (Request $request) {
        $user = $request->user();
        $user->forceFill([
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'two_factor_confirmed_at' => null,
        ])->save();

        return back()->with('status', 'La double authentification a été désactivée.');
    })->name('two-factor.disable');
});

Route::get('/two-factor/login', function () {
    return view('auth.two-factor-challenge');
})->name('two-factor.login');

// Socialite Google
Route::get('/auth/google', function () {
    return Socialite::driver('google')->redirect();
})->name('google.redirect');

Route::get('/auth/google/callback', function () {
    $googleUser = Socialite::driver('google')->stateless()->user();

    $user = User::firstOrCreate(
        ['email' => $googleUser->email],
        [
            'name' => $googleUser->name,
            'password' => bcrypt(Str::random(16)),
        ]
    );

    Auth::login($user);

    return redirect('/dashboard');
});


// Autres fichiers de routes
require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
