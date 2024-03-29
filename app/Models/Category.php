<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = "categories";

    protected $fillable = ['id', 'name', 'slug', 'url'];

    public function subCategory()
    {
        return $this->hasMany(Subcategory::class);
    }

}
