<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOutput extends Model
{
    use HasFactory;

    protected $table = "product_outputs";

    public function salidas()
    {
        return $this->belongsTo(output::class, 'output_id', 'id')->withDefault();
    }

    public function producto()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id')->withDefault();
    }
}
