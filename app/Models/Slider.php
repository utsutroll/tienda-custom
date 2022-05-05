<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $table = "sliders";

    protected $fillable = [
        'title',
        'subtitle',
        'detail',
        'status',
        'slug',
        'link'
    ];
    
    public function getRouteKeyName()
    {
        return 'slug';
    }

    //relacion 1 a 1 polimorfica

    public function image(){
        return $this->morphOne(ImgSlider::class,'imagen');
    }
}
