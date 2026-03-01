<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['order_id','product_id', 'quantity', 'price'];

    // Order pemilik item ini
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Produk di item ini
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}