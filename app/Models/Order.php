<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'customer_id',
        'order_date',
        'zip_code',
        'province',
        'city',
        'street',
        'total',
        'status'
    ];
    //declares a relation
    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }
    //declares a relation
    public function customer(){
        return $this->belongsTo(User::class);
    }
}
