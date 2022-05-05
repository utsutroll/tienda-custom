<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;

    protected $table = "bank_accounts";

    protected $fillable = [
        'type_account', 
        'account',
        'cedula',
        'phone',
        'beneficiary',
        'bank_id',
        'type_d',
        'pm'
    ];

    /**Relacion 1 a muchos **/

    public function bank(){
        return $this->belongsTo(Bank::class);
    }

    public function transactions()
    {
        return $this->hasOne(Transaction::class);
    }
}
