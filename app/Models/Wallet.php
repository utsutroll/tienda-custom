<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $table = "wallets";

    protected $fillable = ['type', 'wallet_email', 'name'];

    public function transactions()
    {
        return $this->hasOne(Transaction::class);
    }
}
