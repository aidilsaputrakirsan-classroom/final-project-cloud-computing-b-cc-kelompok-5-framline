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
    ];

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'film_genre');
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
}
