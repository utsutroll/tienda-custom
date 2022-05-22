<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CharacteristicProduct extends Model
{
    use HasFactory;

    protected $table = "characteristic_product";

    protected $fillable = ['characteristic_id', 'product_id', 'image', 'stock', 'price', 'sale_price'];

    public function characteristic()
    {
        return $this->belongsTo(Characteristic::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function characteristic_product_entries()
    {
        return $this->hasMany(CharacteristicProductEntry::class);
    }

    public function characteristic_product_outputs()
    {
        return $this->hasMany(CharacteristicProductOutput::class);
    }
}
