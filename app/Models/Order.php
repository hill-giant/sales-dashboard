<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    const CREATED_AT = 'purchase_date';
    protected $fillable = [
        "customer_id",
        "country",
        "device"
    ];

    public function orderItems()
    {
        return $this->hasMany('App\Models\OrderItem');
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'foreign_key');
    }
}
