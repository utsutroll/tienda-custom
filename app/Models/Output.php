<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Output extends Model
{
    use HasFactory;

    protected $table = "outputs";
    
    protected $fillable = ['date', 'time'];

    public function characteristic_product_output()
    {
        return $this->hasMany(CharacteristicProductOutput::class);
    }
}
