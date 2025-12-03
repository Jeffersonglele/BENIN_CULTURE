<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Langue extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom_langue',
        'code_langue',
        'description',
    ];

    /**
     * Get the contenus for this langue.
     */
    public function contenus(): HasMany
    {
        return $this->hasMany(Contenu::class, 'id_langue');
    }

    /**
     * Get the regions that speak this langue.
     */
    public function regions(): BelongsToMany
    {
        return $this->belongsToMany(Region::class, 'parler', 'id_langue', 'id_region')
                    ->withTimestamps();
    }

    /**
     * Get the users who use this language.
     */
    public function utilisateurs(): HasMany
    {
        return $this->hasMany(Utilisateur::class, 'id_langue');
    }
}
