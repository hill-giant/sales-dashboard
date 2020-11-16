<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = "order_items";
    protected $fillable = [
        "order_id",
        "EAN",
        "quantity",
        "price"
    ];

    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'foreign_key');
    }
}
