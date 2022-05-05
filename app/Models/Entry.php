<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    use HasFactory;

    protected $table = "entries";

    protected $fillable = ['date', 'time'];

    public function productEntry()
    {
        return $this->hasMany(ProductEntry::class);
    }
}