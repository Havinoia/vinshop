<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'total_price',
        'status',
        'shipping_address',
        'payment_status'
    ];

    // User pemilik order ini
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Item-item dalam order ini
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Pembayaran order ini
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}