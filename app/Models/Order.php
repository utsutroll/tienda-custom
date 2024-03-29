<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = "orders";

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    public function characteristic_product_order()
    {
        return $this->hasMany(CharacteristicProductOrder::class);
    }

    public function shipping()
    {
        return $this->hasOne(Shipping::class);
    }

    public function transactions()
    {
        return $this->hasOne(Transaction::class);
    }
}
