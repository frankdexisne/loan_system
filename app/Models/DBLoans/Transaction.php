<?php

namespace App\Models\DBLoans;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $connection = 'mysql';

    protected $fillable = [
        'wallet_id',
        'amount',
        'confirmed'
    ];

    public function wallet(){
        return $this->belongsTo(Wallet::class);
    }
}
