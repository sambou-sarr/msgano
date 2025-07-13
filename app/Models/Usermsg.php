<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usermsg extends Authenticatable
{
    use Notifiable;

    protected $table = 'usersmsg'; // ← table personnalisée

    protected $fillable = [
        'username',
        'password',
        'is_admin',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getAuthIdentifierName()
    {
        return 'username';
    }
}
