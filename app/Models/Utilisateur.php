<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Utilisateur extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'utilisateurs';

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'mot_de_passe',
        'date_naissance',
        'date_inscription',
        'statut',
        'photo',
        'id_role',
        'id_langue',
        'password', // Ajoutez ceci
    ];

    protected $hidden = [
        'mot_de_passe',
        'password', // Ajoutez ceci
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'mot_de_passe' => 'hashed',
        'password' => 'hashed', // Ajoutez ceci
    ];

    // Spécifier que le mot de passe est stocké dans la colonne 'mot_de_passe'
    public function getAuthPassword()
    {
        return $this->mot_de_passe;
    }

    // Relation avec la table des rôles
    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role');
    }

    // Relation avec la table des langues
    public function langue()
    {
        return $this->belongsTo(Langue::class, 'id_langue');
    }

    public function aAccesAuContenu($contenuId)
    {
        return $this->paiements()
            ->where('contenu_id', $contenuId)
            ->where('statut', 'payé')
            ->exists();
    }
}