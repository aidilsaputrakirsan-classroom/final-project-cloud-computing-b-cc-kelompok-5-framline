<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_admin' => 'boolean',
    ];

    public function isAdmin(): bool
    {
        return (bool) $this->is_admin;
    }

    public function auditLogs()
    {
        return $this->hasMany(AuditLog::class);
    }
    public function favoriteFilms()
    {
        return $this->belongsToMany(Film::class, 'film_user_favorites');
    }

    public function watchedFilms()
    {
        return $this->belongsToMany(Film::class, 'film_user_history')->withPivot('watched_at')->withTimestamps();
    }

}
