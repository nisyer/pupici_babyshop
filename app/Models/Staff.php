<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Staff extends Authenticatable
{
    use HasFactory;

    protected $table = 'staff';

    protected $fillable = [
        'staff_id',
        'name',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
    ];
}



