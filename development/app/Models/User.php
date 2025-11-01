<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'username', 'email', 'password', 'role_id'
    ];

    protected $hidden = ['password'];

    public function role() {
        return $this->belongsTo(Role::class, 'role_id', 'role_id');
    }
}
