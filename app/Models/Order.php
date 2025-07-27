<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    // Relationship: Setiap order milik seorang customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Relationship: Setiap order boleh ada banyak produk
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product')
                    ->withPivot('quantity', 'design', 'color')
                    ->withTimestamps();
    }
}
