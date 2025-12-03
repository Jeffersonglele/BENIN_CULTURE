<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Utilisateur;

class LoginHistory extends Model
{
    protected $fillable = [
        'user_id',
        'user_type',
        'ip_address',
        'user_agent',
        'login_at'
    ];

    protected $dates = ['login_at'];

    /**
     * Relation avec le modèle d'utilisateur approprié en fonction du type d'utilisateur
     */
    public function user()
    {
        return $this->morphTo('user', 'user_type', 'user_id', 'id');
    }

    /**
     * Relation avec le modèle User (pour les administrateurs)
     */
    public function admin()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relation avec le modèle Utilisateur (pour les auteurs)
     */
    public function auteur()
    {
        return $this->belongsTo(Utilisateur::class, 'user_id');
    }
}
