<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommentaireNote extends Model
{
    protected $fillable = [
        'commentaire_id',
        'user_id',
        'note'
    ];

    public function commentaire(): BelongsTo
    {
        return $this->belongsTo(Commentaire::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}