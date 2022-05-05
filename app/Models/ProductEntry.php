<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductEntry extends Model
{
    use HasFactory;

    protected $table = "product_entries";

    public function entry()
    {
        return $this->belongsTo(Entry::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
