<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'profile_photo_path',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    /**
     * Relation avec les contenus de l'utilisateur
     */
    public function contenus()
    {
        return $this->hasMany(\App\Models\Contenu::class, 'id_utilisateur');
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => 'string',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->getTable() === 'users';
    }

    public function isManager(): bool
    {
        return $this->role && $this->role->nom_role === 'manager' || $this->isAdmin();
    }

    public function isUser(): bool
    {
        return $this->role === 'user';
    }
    
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    public function loginHistories()
    {
        return $this->hasMany(LoginHistory::class);
    }
}
