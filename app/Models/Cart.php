<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'cart';
    protected $fillable = ['subtotal', 'customer_id'];

public function products()
{
    return $this->belongsToMany(Product::class, 'cart_product')
                ->withPivot('quantity', 'price')
                ->withTimestamps();
}


public function cartProducts()
{
    return $this->hasMany(CartProduct::class);
}


}
