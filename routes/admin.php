<?php

use Illuminate\Support\Facades\Route;

Route::get('/admin', function () {
    return view('auth.login');
})->name('admin');

Route::get('/admin/dashboard/culture', [\App\Http\Controllers\HomeController::class, 'index'])->name('admin.culture');


Route::get('/index', function () {
    return view('index');
})->name('accueil');



Route::get('/langues/index', [\App\Http\Controllers\LanguesController::class, 'index'])->name('langues');
Route::get('/langues/create', [\App\Http\Controllers\LanguesController::class, 'create'])->name('langues.create');
Route::post('/langues', [\App\Http\Controllers\LanguesController::class, 'store'])->name('langues.store');
Route::get('/langues/{id}', [\App\Http\Controllers\LanguesController::class, 'show'])->name('langues.show');
Route::get('/langues/{id}/edit', [\App\Http\Controllers\LanguesController::class, 'edit'])->name('langues.edit');
Route::put('/langues/{id}', [\App\Http\Controllers\LanguesController::class, 'update'])->name('langues.update');
Route::delete('/langues/{id}', [\App\Http\Controllers\LanguesController::class, 'destroy'])->name('langues.destroy');

Route::get('/regions/index', [\App\Http\Controllers\RegionController::class, 'index'])->name('regions');
Route::get('/regions/create', [\App\Http\Controllers\RegionController::class, 'create'])->name('regions.create');
Route::post('/regions', [\App\Http\Controllers\RegionController::class, 'store'])->name('regions.store');
Route::get('/regions/{id}', [\App\Http\Controllers\RegionController::class, 'show'])->name('regions.show');
Route::get('/regions/{id}/edit', [\App\Http\Controllers\RegionController::class, 'edit'])->name('regions.edit');
Route::put('/regions/{id}', [\App\Http\Controllers\RegionController::class, 'update'])->name('regions.update');
Route::delete('/regions/{id}', [\App\Http\Controllers\RegionController::class, 'destroy'])->name('regions.destroy');


Route::get('/utilisateurs/index', [\App\Http\Controllers\UtilisateurController::class, 'index'])->name('utilisateurs');
Route::get('/utilisateurs/create', [\App\Http\Controllers\UtilisateurController::class, 'create'])->name('utilisateurs.create');
Route::post('/utilisateurs', [\App\Http\Controllers\UtilisateurController::class, 'store'])->name('utilisateurs.store');
Route::get('/utilisateurs/{id}', [\App\Http\Controllers\UtilisateurController::class, 'show'])->name('utilisateurs.show');
Route::get('/utilisateurs/{id}/edit', [\App\Http\Controllers\UtilisateurController::class, 'edit'])->name('utilisateurs.edit');
Route::put('/utilisateurs/{id}', [\App\Http\Controllers\UtilisateurController::class, 'update'])->name('utilisateurs.update');
Route::delete('/utilisateurs/{id}', [\App\Http\Controllers\UtilisateurController::class, 'destroy'])->name('utilisateurs.destroy');

Route::get('/contenus/index', [\App\Http\Controllers\ContenusController::class, 'index'])->name('contenus');
Route::get('/contenus/create', [\App\Http\Controllers\ContenusController::class, 'create'])->name('contenus.create');
Route::post('/contenus', [\App\Http\Controllers\ContenusController::class, 'store'])->name('contenus.store');
Route::get('/contenus/{id}', [\App\Http\Controllers\ContenusController::class, 'show'])->name('contenus.show');
Route::get('/contenus/{id}/edit', [\App\Http\Controllers\ContenusController::class, 'edit'])->name('contenus.edit');
Route::put('/contenus/{id}', [\App\Http\Controllers\ContenusController::class, 'update'])->name('contenus.update');
Route::delete('/contenus/{id}', [\App\Http\Controllers\ContenusController::class, 'destroy'])->name('contenus.destroy');
Route::patch('/contenus/{contenu}/status', [\App\Http\Controllers\ContenusController::class, 'updateStatus'])
    ->name('contenus.updateStatus');


Route::get('/medias/index', [\App\Http\Controllers\MediasController::class, 'index'])->name('medias');
Route::get('/medias/create', [\App\Http\Controllers\MediasController::class, 'create'])->name('medias.create');
Route::post('/medias', [\App\Http\Controllers\MediasController::class, 'store'])->name('medias.store');
Route::get('/medias/{id}', [\App\Http\Controllers\MediasController::class, 'show'])->name('medias.show');
Route::get('/medias/{id}/edit', [\App\Http\Controllers\MediasController::class, 'edit'])->name('medias.edit');
Route::put('/medias/{id}', [\App\Http\Controllers\MediasController::class, 'update'])->name('medias.update');
Route::delete('/medias/{id}', [\App\Http\Controllers\MediasController::class, 'destroy'])->name('medias.destroy');

Route::get('/commentaires/index', [\App\Http\Controllers\CommentairesController::class, 'index'])->name('commentaires');
Route::get('/commentaires/create', [\App\Http\Controllers\CommentairesController::class, 'create'])->name('commentaires.create');
Route::post('/commentaires', [\App\Http\Controllers\CommentairesController::class, 'store'])->name('commentaires.store');
Route::get('/commentaires/{id}', [\App\Http\Controllers\CommentairesController::class, 'show'])->name('commentaires.show');
Route::get('/commentaires/{id}/edit', [\App\Http\Controllers\CommentairesController::class, 'edit'])->name('commentaires.edit');
Route::put('/commentaires/{id}', [\App\Http\Controllers\CommentairesController::class, 'update'])->name('commentaires.update');
Route::delete('/commentaires/{id}', [\App\Http\Controllers\CommentairesController::class, 'destroy'])->name('commentaires.destroy');

Route::get('/type_contenu', [\App\Http\Controllers\TypeContenuController::class, 'index'])->name('type_contenu');
Route::get('/type_contenu/create', [\App\Http\Controllers\TypeContenuController::class, 'create'])->name('type_contenu.create');
Route::post('/type_contenu', [\App\Http\Controllers\TypeContenuController::class, 'store'])->name('type_contenu.store');
Route::get('/type_contenu/{id}', [\App\Http\Controllers\TypeContenuController::class, 'show'])->name('type_contenu.show');
Route::get('/type_contenu/{id}/edit', [\App\Http\Controllers\TypeContenuController::class, 'edit'])->name('type_contenu.edit');
Route::put('/type_contenu/{id}', [\App\Http\Controllers\TypeContenuController::class, 'update'])->name('type_contenu.update');
Route::delete('/type_contenu/{id}', [\App\Http\Controllers\TypeContenuController::class, 'destroy'])->name('type_contenu.destroy');


Route::get('/type_media', [\App\Http\Controllers\TypeMediaController::class, 'index'])->name('type_media');
Route::get('/type_media/create', [\App\Http\Controllers\TypeMediaController::class, 'create'])->name('type_media.create');
Route::post('/type_media', [\App\Http\Controllers\TypeMediaController::class, 'store'])->name('type_media.store');
Route::get('/type_media/{id}', [\App\Http\Controllers\TypeMediaController::class, 'show'])->name('type_media.show');
Route::get('/type_media/{id}/edit', [\App\Http\Controllers\TypeMediaController::class, 'edit'])->name('type_media.edit');
Route::put('/type_media/{id}', [\App\Http\Controllers\TypeMediaController::class, 'update'])->name('type_media.update');
Route::delete('/type_media/{id}', [\App\Http\Controllers\TypeMediaController::class, 'destroy'])->name('type_media.destroy');
//Route::get('/langue/index', [App\Http\Controllers\LanguesController::class, 'index']);


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('welcome');
    })->name('admin.dashboard');
});

Route::middleware(['auth', 'role:manager'])->group(function () {
    Route::get('/manager/dashboard', function () {
        return view('welcome');
    })->name('manager.dashboard');
});

// Route pour les utilisateurs normaux
Route::middleware('auth')->group(function () {
    Route::get('/home', function () {
        return view('home');
    })->name('home');
});
/*
Route::get('/langue', function () {
    return view('langues.index');
}); */
/* Route::get('/langues/show/{id}', function ($id) {
    return view('langues/show' ,compact ('id'));
});  */
//Route::get('/langues', [App\Http\Controllers\LangueController::class, 'index']);
//Route::get('/langues/edit/{id}', [App\Http\Controllers\HomeController::class, 'edit'])->name('langues.show');
//Route::resource('langues', [App\Http\Controllers\LanguesController::class]);