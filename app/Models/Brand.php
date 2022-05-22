<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $table = "brands";

    protected $fillable = ['name', 'slug'];

    /**Relacion 1 a muchos **/

    public function products(){
        return $this->hasMany(Product::class);
    }
}
