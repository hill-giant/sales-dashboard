<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';
    protected $fillable = [
        "first_name",
        "last_name",
        "email"
    ];
    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function orderItems()
    {
        return $this->hasManyThrough('App\Models\OrderItem','App\Models\Order');
    }
}
