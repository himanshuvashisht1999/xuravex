<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_number', 'user_id', 'total_amount', 'discount_amount', 'shipping_amount', 'payable_amount',
        'billing_name', 'billing_email', 'billing_phone', 'billing_address', 'billing_city', 'billing_state', 'billing_pincode', 'billing_country',
        'shipping_name', 'shipping_email', 'shipping_phone', 'shipping_address', 'shipping_city', 'shipping_state', 'shipping_pincode', 'shipping_country',
        'payment_method', 'payment_status', 'order_status', 'notes'
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
