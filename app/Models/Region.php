<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Region extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom_region',
        'description',
        'population',
        'superficie',
        'localisation',
    ];

    /**
     * Get the contenus for this region.
     */
    public function contenus(): HasMany
    {
        return $this->hasMany(Contenu::class, 'id_region');
    }

    /**
     * Get the langues spoken in this region.
     */
    public function langues(): BelongsToMany
    {
        return $this->belongsToMany(Langue::class, 'parler', 'id_region', 'id_langue')
                    ->withTimestamps();
    }
}

