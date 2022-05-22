<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CharacteristicProductEntry extends Model
{
    use HasFactory;

    protected $table = "characteristic_product_entry";

    public function entry()
    {
        return $this->belongsTo(Entry::class);
    }

    public function characteristic_product()
    {
        return $this->belongsTo(CharacteristicProduct::class);
    }
}
