<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Utilisateur extends Model
{
    protected $table = 'utilisateurs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'statut',
        'date_naissance',
        'date_inscription',
        'mot_de_passe',
        'photo',
        'id_role',
        'id_langue'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'mot_de_passe',
    ];

    /**
     * Get the contenus authored by this user.
     */
    public function contenusAuteur(): HasMany
    {
        return $this->hasMany(Contenu::class, 'id_auteur');
    }

    /**
     * Get the contenus moderated by this user.
     */
    public function contenusModerateur(): HasMany
    {
        return $this->hasMany(Contenu::class, 'id_moderateur');
    }

    /**
     * Get the commentaires by this user.
     */
    public function commentaires(): HasMany
    {
        return $this->hasMany(Commentaire::class, 'id_utilisateur');
    }

    /**
     * Get the role that owns the user.
     */
    public function role(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Role::class, 'id_role');
    }

    /**
     * Get the language of the user.
     */
    public function langue(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Langue::class, 'id_langue');
    }
}

