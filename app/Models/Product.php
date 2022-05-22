<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table='products';

    protected $primaryKey = 'id';  // or null

    public $incrementing = false;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $fillable = [
        'id',
        'name',
        'subcategory_id',
        'presentation_id',
        'brand_id',
        'slug',
        'details',
    ];

    public function subcategory(){
        return $this->belongsTo(Subcategory::class);
    }

    public function presentation(){
        return $this->belongsTo(Presentation::class);
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    //Relacion muchos a muchos

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
    

    public function characteristics_product()
    {
        return $this->hasMany(CharacteristicProduct::class);
    }

    //relacion 1 a 1 polimorfica

    public function image(){
        return $this->morphOne(Image::class,'imageable');
    }
}
