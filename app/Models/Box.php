<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'subscription_type',  // twice a week,weekly ,monthly, once every 4 months, once every 6 months, once every 12 months
        'status',
        'price',
    ];

    public function customer(){
        return $this->belongsTo(User::class);
    }

    public function boxItems(){
        return $this->hasMany(OrderItem::class);
    }
}
