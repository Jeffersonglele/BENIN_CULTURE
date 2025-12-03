<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TypeContenu extends Model
{
    protected $table = 'type_contenus';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom_type_contenu',
    ];

    /**
     * Get the contenus for this type.
     */
    public function contenus(): HasMany
    {
        return $this->hasMany(Contenu::class, 'id_type_contenu');
    }

    /**
     * Get the medias for this type.
     */
    public function medias(): HasMany
    {
        return $this->hasMany(Media::class, 'id_type_contenu');
    }
}

