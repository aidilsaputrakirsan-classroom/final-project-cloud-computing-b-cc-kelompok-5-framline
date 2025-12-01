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
        return $this->belongsTo(Genre::class, 'genre_id');
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

        // If it's already an 11-char video ID
        if (strlen($url) == 11 && preg_match('/^[a-zA-Z0-9_-]+$/', $url)) {
            return $url;
        }

        // Format: https://www.youtube.com/watch?v=xxxxx
        if (strpos($url, 'v=') !== false) {
            $parts = explode('v=', $url);
            return explode('&', $parts[1])[0]; // Handle additional params
        }

        // Format: https://youtu.be/xxxx
        if (strpos($url, 'youtu.be/') !== false) {
            $parts = explode('youtu.be/', $url);
            return explode('?', $parts[1])[0]; // Handle additional params
        }

        // Format: https://www.youtube.com/embed/xxxxx
        if (strpos($url, 'embed/') !== false) {
            $parts = explode('embed/', $url);
            return explode('?', $parts[1])[0]; // Handle additional params
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

    /**
     * URL lengkap untuk menonton di YouTube.
     */
    public function getTrailerWatchUrlAttribute()
    {
        return $this->youtube_id
            ? "https://www.youtube.com/watch?v=" . $this->youtube_id
            : null;
    }

    /**
     * HTML embed untuk iframe YouTube.
     */
    public function getOEmbedHtmlAttribute()
    {
        return $this->embed_url
            ? '<iframe width="100%" height="100%" src="' . $this->embed_url . '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>'
            : null;
    }
}
