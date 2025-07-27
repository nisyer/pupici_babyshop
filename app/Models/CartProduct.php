<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
    protected $table = 'cart_product';
    protected $fillable = ['cart_id', 'product_id', 'quantity', 'price'];

    public function product()
    {
        return $this->belongsTo(Product::class);
        
    }
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}

