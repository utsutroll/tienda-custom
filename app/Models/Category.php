<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = "categories";

    protected $fillable = ['name', 'slug'];

    /**Relacion 1 a muchos **/

    public function products(){
        return $this->hasMany(Product::class);
    }
}
