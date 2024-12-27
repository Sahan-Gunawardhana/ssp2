<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class OrderItem extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'total',
        'box_id'
    ];

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function product(){
        return $this-> belongsTo(Product::class);
    }

    public function box(){
        return $this-> belongsTo(Box::class);
    }
}
