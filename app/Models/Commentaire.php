<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\CommentaireNote;

class Commentaire extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'texte',
        'note',
        'date',
        'id_utilisateur',
        'id_contenu',
    ];

    /**
     * Get the utilisateur that owns the commentaire.
     */
    public function utilisateur(): BelongsTo
    {
        return $this->belongsTo(Utilisateur::class, 'id_utilisateur');
    }

    /**
     * Get the contenu that owns the commentaire.
     */
    public function contenu(): BelongsTo
    {
        return $this->belongsTo(Contenu::class, 'id_contenu');
    }

    public function notes()
    {
        return $this->hasMany(CommentaireNote::class, 'commentaire_id');
    }

    public function averageNote()
    {
        return $this->notes()->avg('note');
    }

    public function userNote($userId)
    {
        $note = $this->notes()->where('user_id', $userId)->first();
        return $note ? $note->note : null;
    }
}

