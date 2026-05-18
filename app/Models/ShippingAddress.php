<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'shipping_title',
        'first_name',
        'last_name',
        'address',
        'apartment',
        'city',
        'state',
        'zip',
        'country',
        'phone',
        'company',
        'is_default',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
