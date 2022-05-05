<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $table = "banks";

    protected $fillable = ['code', 'name'];

    public function transactions()
    {
        return $this->hasOne(BankAccount::class);
    }
}
