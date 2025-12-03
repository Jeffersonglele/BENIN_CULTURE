<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\ContenusController;
use App\Http\Controllers\MediasController;
use App\Http\Controllers\CommentairesController;
use App\Http\Controllers\TypeContenuController;
use App\Http\Controllers\TypeMediaController;
use App\Http\Controllers\LanguesController;
use App\Http\Controllers\RegionController;

// Groupe de routes protégées par authentification
Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        // Tableau de bord et statistiques
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // Gestion des utilisateurs
        Route::resource('utilisateurs', UtilisateurController::class)->names([
            'index' => 'utilisateurs.index',
            'create' => 'utilisateurs.create',
            'store' => 'utilisateurs.store',
            'show' => 'utilisateurs.show',
            'edit' => 'utilisateurs.edit',
            'update' => 'utilisateurs.update',
            'destroy' => 'utilisateurs.destroy',
        ]);
        
        // Gestion des contenus
        Route::resource('contenus', ContenusController::class)->names([
            'index' => 'contenus.index',
            'create' => 'contenus.create',
            'store' => 'contenus.store',
            'show' => 'contenus.show',
            'edit' => 'contenus.edit',
            'update' => 'contenus.update',
            'destroy' => 'contenus.destroy',
            'updateStatus' => 'contenus.updateStatus',
        ]);
        
        // Mise à jour du statut des contenus
        Route::patch('/contenus/{contenu}/status', [ContenusController::class, 'updateStatus'])
            ->name('contenus.updateStatus');
        
        // Gestion des médias
        Route::resource('medias', MediasController::class)->names([
            'index' => 'medias.index',
            'create' => 'medias.create',
            'store' => 'medias.store',
            'show' => 'medias.show',
            'edit' => 'medias.edit',
            'update' => 'medias.update',
            'destroy' => 'medias.destroy',
        ]);
        
        // Gestion des commentaires
        Route::resource('commentaires', CommentairesController::class)->names([
            'index' => 'commentaires.index',
            'create' => 'commentaires.create',
            'store' => 'commentaires.store',
            'show' => 'commentaires.show',
            'edit' => 'commentaires.edit',
            'update' => 'commentaires.update',
            'destroy' => 'commentaires.destroy',
        ]);
        
        // Gestion des types de contenu
        Route::resource('type-contenu', TypeContenuController::class)->names([
            'index' => 'type_contenu.index',
            'create' => 'type_contenu.create',
            'store' => 'type_contenu.store',
            'show' => 'type_contenu.show',
            'edit' => 'type_contenu.edit',
            'update' => 'type_contenu.update',
            'destroy' => 'type_contenu.destroy',
        ]);
        
        // Gestion des types de média
        Route::resource('type-media', TypeMediaController::class)->names([
            'index' => 'type_media.index',
            'create' => 'type_media.create',
            'store' => 'type_media.store',
            'show' => 'type_media.show',
            'edit' => 'type_media.edit',
            'update' => 'type_media.update',
            'destroy' => 'type_media.destroy',
        ]);
        
        // Gestion des langues
        Route::resource('langues', LanguesController::class)->names([
            'index' => 'langues.index',
            'create' => 'langues.create',
            'store' => 'langues.store',
            'show' => 'langues.show',
            'edit' => 'langues.edit',
            'update' => 'langues.update',
            'destroy' => 'langues.destroy',
        ]);
        
        // Gestion des régions
        Route::resource('regions', RegionController::class)->names([
            'index' => 'regions.index',
            'create' => 'regions.create',
            'store' => 'regions.store',
            'show' => 'regions.show',
            'edit' => 'regions.edit',
            'update' => 'regions.update',
            'destroy' => 'regions.destroy',
        ]);
    });
});