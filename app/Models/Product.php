<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Product extends Model
{
    protected $fillable = [
        'name',
        'price',
        'quantity',
        'description',
        'image',
        'color',        // disimpan sebagai array
        'category_id',
        'is_active',
        'size',
        'design'
    ];

    protected $casts = [
        'color' => 'array',
        'is_active' => 'boolean',
    ];

    // Product belongs to a category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Product belongs to many carts (via cart_product pivot)
    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'cart_product')
                    ->withPivot('quantity', 'price')
                    ->withTimestamps();
    }

    // Product belongs to many orders (via order_product pivot)
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_product')
                    ->withPivot('quantity', 'design', 'color')
                    ->withTimestamps();
    }
}
