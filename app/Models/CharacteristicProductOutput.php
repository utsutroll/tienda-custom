<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CharacteristicProductOutput extends Model
{
    use HasFactory;

    protected $table = "characteristic_product_output";

    public function output()
    {
        return $this->belongsTo(Output::class);
    }

    public function characteristic_product()
    {
        return $this->belongsTo(CharacteristicProduct::class);
    }
}
