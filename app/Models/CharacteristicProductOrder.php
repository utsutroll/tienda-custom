<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CharacteristicProductOrder extends Model
{
    use HasFactory;

    protected $table = "characteristic_product_order";

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function characteristic_product()
    {
        return $this->belongsTo(CharacteristicProduct::class);
    }
}
