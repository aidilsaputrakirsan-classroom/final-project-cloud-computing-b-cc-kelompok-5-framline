<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = ['name', 'image', 'description'];

    protected $table = 'genres';

    // SATU genre punya banyak film
    public function films()
    {
        return $this->hasMany(Film::class, 'genre_id');
    }
}
