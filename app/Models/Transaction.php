<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = "transactions";

    public function order()
    {
        return $this->belongsTo(Order::class);
    } 

    public function bank()
    {
        return $this->belongsTo(BankAccount::class);
    } 

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    } 


}
