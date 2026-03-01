<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'image',
        'is_active'
    ];

    // Kategori produk ini
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Foto-foto produk
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    // Produk di keranjang
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    // Produk di order
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}