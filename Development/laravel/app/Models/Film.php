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
        'trailer_url', 
    ];

    /*
    |--------------------------------------------------------------------------
    | RELASI
    |--------------------------------------------------------------------------
    */

    // Genre film
    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    // User yang mengupload film
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Pengguna yang memfavoritkan film
    public function favoritedByUsers()
    {
        return $this->belongsToMany(User::class, 'film_user_favorites')
            ->withTimestamps();
    }

    // History tontonan
    public function watchedByUsers()
    {
        return $this->belongsToMany(User::class, 'film_user_history')
            ->withPivot('watched_at')
            ->withTimestamps();
    }


    /*
    |--------------------------------------------------------------------------
    | HELPER TRAILER (YouTube ID + Embed)
    |--------------------------------------------------------------------------
    */

    /**
     * Mengambil YouTube video ID dari berbagai format URL.
     */
    public function getYoutubeIdAttribute()
    {
        $url = $this->trailer_url;

        if (!$url) return null;

        // Format: https://www.youtube.com/watch?v=xxxxx
        if (strpos($url, 'v=') !== false) {
            return explode('v=', $url)[1];
        }

        // Format: https://youtu.be/xxxx
        if (strpos($url, 'youtu.be/') !== false) {
            return explode('youtu.be/', $url)[1];
        }

        return null;
    }

    /**
     * Menghasilkan URL embed YouTube.
     */
    public function getEmbedUrlAttribute()
    {
        return $this->youtube_id
            ? "https://www.youtube.com/embed/" . $this->youtube_id
            : null;
    }

    /**
     * Thumbnail otomatis dari YouTube.
     */
    public function getTrailerThumbnailAttribute()
    {
        return $this->youtube_id
            ? "https://img.youtube.com/vi/" . $this->youtube_id . "/hqdefault.jpg"
            : null;
    }
}
