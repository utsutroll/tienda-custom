<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DollarRate extends Model
{
    use HasFactory;

    protected $table = "dollar_rates";

    protected $fillable = ['price'];
}
