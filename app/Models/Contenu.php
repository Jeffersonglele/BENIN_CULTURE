<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contenu extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'titre',
        'texte',
        'statut',
        'note',
        'date_creation',
        'date_validation',
        'id_region',
        'id_langue',
        'id_moderateur',
        'id_type_contenu',
        'id_auteur',
    ];

    /**
     * Get the region that owns the contenu.
     */
    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class, 'id_region');
    }

    /**
     * Get the langue that owns the contenu.
     */
    public function langue(): BelongsTo
    {
        return $this->belongsTo(Langue::class, 'id_langue');
    }

    /**
     * Get the moderateur that owns the contenu.
     */
    public function moderateur(): BelongsTo
    {
        return $this->belongsTo(Utilisateur::class, 'id_moderateur');
    }

    /**
     * Get the auteur that owns the contenu.
     */
    public function auteur(): BelongsTo
    {
        return $this->belongsTo(Utilisateur::class, 'id_auteur');
    }

    /**
     * Get the type_contenu that owns the contenu.
     */
    public function typeContenu(): BelongsTo
    {
        return $this->belongsTo(TypeContenu::class, 'id_type_contenu');
    }

    /**
     * Get the commentaires for the contenu.
     */
    public function commentaires(): HasMany
    {
        return $this->hasMany(Commentaire::class, 'id_contenu');
    }

    /**
     * Get the medias for the contenu.
     */
    public function medias(): HasMany
    {
        return $this->hasMany(Media::class, 'id_contenu');
    }
}

