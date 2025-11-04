<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $fillable = [
        'poster',
        'judul',
        'sinopsis',
        'tahun_rilis',
        'sutradara',
        'aktor',
        'durasi',
        'genre_id',
        'user_id',
    ];

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    // ✅ Relasi ke user (film yang diupload user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favoritedByUsers()
    {
        return $this->belongsToMany(User::class, 'film_user_favorites');
    }

    public function watchedByUsers()
    {
        return $this->belongsToMany(User::class, 'film_user_history')->withPivot('watched_at')->withTimestamps();
    }
}
