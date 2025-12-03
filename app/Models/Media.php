<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Media extends Model
{
    protected $table = 'medias';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'chemin',
        'description',
        'id_contenu',
        'id_type_contenu',
        'prix',
        'transaction_id'
    ];

    /**
     * Get the contenu that owns the media.
     */
    public function contenu(): BelongsTo
    {
        return $this->belongsTo(Contenu::class, 'id_contenu');
    }

    /**
     * Get the type_contenu that owns the media.
     */
    public function typeContenu(): BelongsTo
    {
        return $this->belongsTo(TypeContenu::class, 'id_type_contenu');
    }
}


