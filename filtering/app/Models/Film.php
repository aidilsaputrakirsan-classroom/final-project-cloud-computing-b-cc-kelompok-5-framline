<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $fillable = [
        'title','description','director','release_date','duration','poster_url','trailer_url'
    ];

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'film_genre');
    }

    public function auditLogs()
    {
        return $this->hasMany(AuditLog::class);
    }
}
