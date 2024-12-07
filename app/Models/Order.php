<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function customer(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }
    public function city(){
        return $this->belongsTo(region::class);
    }
    public function country(){
        return $this->belongsTo(country::class);
    }
}
