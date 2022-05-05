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
        'slug',
        'details',
        'price',
        'sale_price',
        'category_id',
        'presentation_id',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function presentation(){
        return $this->belongsTo(Presentation::class);
    }

    //Relacion muchos a muchos

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
    
    public function productEntries()
    {
        return $this->hasMany(ProductEntry::class);
    }
    
    public function salidas()
    {
        return $this->hasMany(ProductOutput::class);
    }

    //relacion 1 a 1 polimorfica

    public function image(){
        return $this->morphOne(Image::class,'imageable');
    }
}