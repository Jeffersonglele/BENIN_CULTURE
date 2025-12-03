<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Google2FA\Google2FA;
use Illuminate\Support\Str;
use Laravel\Fortify\RecoveryCode;
use App\Models\User;
use App\Http\Controllers\front\LangueController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\front\ShowContenuController;
use App\Http\Controllers\front\RegionshowController;
use App\Http\Controllers\CommentaireNoteController;
use App\Http\Controllers\PaiementController;
use App\Http\Middleware\VerifyCsrfToken;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('front.index');
})->name('home');

// Route du tableau de bord
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::post('/paiement/initier', [PaiementController::class, 'initier']);
Route::get('/paiement/success', [PaiementController::class, 'success'])->name('paiement.success');
Route::get('/paiement/error', [PaiementController::class, 'error'])->name('paiement.error');
Route::match(['get', 'post'], '/paiement/callback', [PaiementController::class, 'callback'])
    ->name('paiement.callback')
    ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);

// Route du tableau de culture
Route::get('/dashboard/culture', [App\Http\Controllers\HomeController::class, 'index'])
    ->middleware(['auth'])
    ->name('admin.culture');


Route::get('/langue', [LangueController::class, 'index'])->name('langue');

Route::get('contenu', [ShowContenuController::class, 'index'])->name('contenu');

Route::get('region', [RegionshowController::class, 'index'])->name('region');
Route::get('contact', function () {
    return view('front.contact');
})->name('contact');
Route::get('tourisme', function () {
    return view('front.tourisme');
})->name('tourisme');

Route::get('/contenu/{id}', [ContenuController::class, 'voir'])
    ->middleware(['auth', 'verifierpaiement'])
    ->name('contenu.voir');

// Routes protégées pour l'auteur
Route::middleware(['auth:utilisateur'])->prefix('author')->name('author.')->group(function () {
    // Routes pour les médias
    Route::post('/medias/init-payment', [\App\Http\Controllers\Author\MediaController::class, 'initPayment'])
        ->name('medias.init-payment');
    
    Route::get('/medias/payment/callback', [\App\Http\Controllers\Author\MediaController::class, 'paymentCallback'])
        ->name('medias.payment.callback');
});

// Routes d'authentification personnalisées
Route::middleware('guest')->group(function () {
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
});

// Routes protégées par auth
Route::middleware('auth')->group(function () {
    // Routes pour FedaPay
    Route::post('/author/medias/callback', [\App\Http\Controllers\Author\MediaController::class, 'handleCallback'])
        ->name('author.medias.callback')
        ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);

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
                $recoveryCodes[] = Str::random(10);
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
    $googleUser = Socialite::driver('google')->user();

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

Route::post('/commentaires/{commentaire}/notes', [CommentaireNoteController::class, 'store'])
    ->name('commentaires.notes.store')
    ->middleware('auth');


// Autres fichiers de routes
require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/author.php';
