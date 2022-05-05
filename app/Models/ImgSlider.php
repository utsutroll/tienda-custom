<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImgSlider extends Model
{
    use HasFactory;

    protected $table='img_sliders';

    protected $fillable = ['url'];

    //relacion polimorfica

    public function imagen(){
        return $this->morphTo(Slider::class);
    }
}
