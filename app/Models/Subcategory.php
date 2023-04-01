<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    protected $table = "subcategories";

    protected $fillable = ['name', 'category_id', 'slug', 'url'];

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
