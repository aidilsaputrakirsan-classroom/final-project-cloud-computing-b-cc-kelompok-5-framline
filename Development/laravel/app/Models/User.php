<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Mass assignable attributes.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
    ];

    /**
     * Hidden attributes.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casts.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_admin' => 'boolean',
    ];

    /**
     * Check if user is admin.
     */
    public function isAdmin(): bool
    {
        return (bool) $this->is_admin;
    }

    /**
     * Audit logs done by user.
     */
    public function auditLogs()
    {
        return $this->hasMany(AuditLog::class);
    }

    /**
     * Favorite films (pivot: film_user_favorites).
     */
    public function favoriteFilms()
    {
        return $this->belongsToMany(Film::class, 'film_user_favorites')
            ->withTimestamps();
    }

    /**
     * Watched film history (pivot: film_user_history).
     */
    public function watchedFilms()
    {
        return $this->belongsToMany(Film::class, 'film_user_history')
            ->withPivot('watched_at')
            ->withTimestamps();
    }
}
