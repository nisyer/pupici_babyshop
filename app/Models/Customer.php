<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use Notifiable;

    protected $table = 'customers'; // Your actual table name

    protected $fillable = ['name', 'phone', 'address', 'email', 'password'];

    protected $hidden = ['password', 'remember_token'];

    // One customer can have many orders
public function orders()
{
    return $this->hasMany(Order::class);
}

}





