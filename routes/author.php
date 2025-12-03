<?php

use App\Http\Controllers\Author\DashboardController;
use App\Http\Controllers\Author\MediaController;
use App\Http\Controllers\Author\ContenuController;
use App\Http\Controllers\Author\CommentController;
use App\Http\Controllers\Author\ProfileController;
use App\Http\Controllers\Auth\AuthorLoginController;
use App\Http\Controllers\Auth\AuthorRegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Author Routes
|--------------------------------------------------------------------------
|
| Routes pour l'authentification et le tableau de bord des auteurs
|
*/


// Routes d'authentification des utilisateurs non connectés
Route::middleware(['web'])->group(function () {
    // Afficher le formulaire de connexion
    Route::get('/author/login', [AuthorLoginController::class, 'showLoginForm'])
        ->name('author.login')
        ->middleware('guest:utilisateur');

    // Soumettre le formulaire de connexion
    Route::post('/author/login', [AuthorLoginController::class, 'login'])
        ->name('author.login.submit')
        ->middleware('guest:utilisateur');

    // Afficher le formulaire d'inscription
    Route::get('/author/register', [AuthorRegisterController::class, 'create'])
        ->name('author.register')
        ->middleware('guest:utilisateur');

    // Soumettre le formulaire d'inscription
    Route::post('/author/register', [AuthorRegisterController::class, 'store'])
        ->name('author.register.submit')
        ->middleware('guest:utilisateur');
});

// Routes protégées pour les utilisateurs connectés
Route::middleware(['web', 'auth:utilisateur'])->group(function () {
    // Déconnexion
    Route::post('/author/logout', [AuthorLoginController::class, 'logout'])
        ->name('author.logout');

    // Tableau de bord
    Route::get('/author/dashboard', [DashboardController::class, 'index'])
        ->name('author.dashboard');

    // Profil utilisateur
    Route::get('/author/profile', [ProfileController::class, 'edit'])->name('author.profile');
    
    // Routes du profil
    Route::prefix('author/profile')->name('author.profile.')->group(function () {
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::match(['put', 'patch'], '/', [ProfileController::class, 'update'])->name('update');
        Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });
    
    // Alias pour la route de mise à jour du mot de passe (compatibilité avec la vue)
    Route::put('/author/password', [ProfileController::class, 'updatePassword'])
        ->name('author.password.update');
    
    // Gestion des médias
    Route::prefix('author/medias')->name('author.medias.')->group(function () {
        Route::get('/', [MediaController::class, 'index'])->name('index');
        Route::get('/create', [MediaController::class, 'create'])->name('create');
        Route::post('/', [MediaController::class, 'store'])->name('store');
        Route::post('/create-payment', [MediaController::class, 'createPayment'])->name('create-payment');
        Route::post('/init-payment', [MediaController::class, 'initPayment'])->name('init-payment');
        Route::get('/payment-callback', [MediaController::class, 'paymentCallback'])->name('payment-callback');
        Route::get('/{id}', [MediaController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [MediaController::class, 'edit'])->name('edit');
        Route::put('/{id}', [MediaController::class, 'update'])->name('update');
        Route::delete('/{id}', [MediaController::class, 'destroy'])->name('destroy');
        Route::post('/create-card-payment', [MediaController::class, 'createCardPayment'])->name('create-card-payment');
    });

    // Gestion des contenus
    Route::prefix('author/contenus')->name('author.contenus.')->group(function () {
        Route::get('/', [ContenuController::class, 'index'])->name('index');
        Route::get('/create', [ContenuController::class, 'create'])->name('create');
        Route::post('/', [ContenuController::class, 'store'])->name('store');  
        Route::get('/{id}', [ContenuController::class, 'show'])->name('show');
        Route::get('/{contenu}/edit', [ContenuController::class, 'edit'])->name('edit');
        Route::put('/{contenu}', [ContenuController::class, 'update'])->name('update');
        Route::delete('/{contenu}', [ContenuController::class, 'destroy'])->name('destroy');
    });
  
    // Gestion des commentaires
    Route::prefix('author/commentaires')->name('author.commentaires.')->group(function () {
        Route::get('/', [CommentController::class, 'index'])->name('index');
        Route::delete('/{commentaire}', [CommentController::class, 'destroy'])->name('destroy');
    });

});