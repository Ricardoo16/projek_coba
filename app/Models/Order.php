<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'code', 'customer_name', 'customer_email', 
        'customer_phone', 'shipping_address', 'total_price', 'status'
    ];
}
