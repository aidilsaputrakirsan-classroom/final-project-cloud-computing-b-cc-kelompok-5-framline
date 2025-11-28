<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'film_id',
        'action',
        'performed_at',
        'meta',
    ];

    protected $casts = [
        'performed_at' => 'datetime',
        'meta'         => 'array',
    ];

    // Relasi
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function film()
    {
        return $this->belongsTo(Film::class);
    }

    // Accessor deskripsi action
    public function getActionDescriptionAttribute(): string
    {
        $filmTitle = $this->film?->title
            ?? ($this->meta['film_title'] ?? null);

        return match ($this->action) {
            'login'           => 'User logged in',
            'logout'          => 'User logged out',
            'register'        => 'User registered',
            'add_favorite'    => $filmTitle
                ? "Added to favorites: {$filmTitle}"
                : 'Added a film to favorites',
            'remove_favorite' => $filmTitle
                ? "Removed from favorites: {$filmTitle}"
                : 'Removed a film from favorites',
            'watch_trailer'   => $filmTitle
                ? "Watched trailer: {$filmTitle}"
                : 'Watched a film trailer',
            'open_film_detail'=> $filmTitle
                ? "Opened film detail: {$filmTitle}"
                : 'Opened a film detail page',
            default           => $this->meta['message'] ?? '-',
        };
    }
}
