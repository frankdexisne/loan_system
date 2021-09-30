<?php

namespace App\Models\DBLoans;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Bavix\Wallet\Traits\HasWallet;
use Bavix\Wallet\Traits\HasWallets;
use Bavix\Wallet\Interfaces\Wallet;
class Branch extends Model
{
    use HasFactory,HasWallet, HasWallets;

    protected $connection = 'mysql';

    protected $fillable = [
        'name'
    ];

    public function area(){
        return $this->hasMany(Area::class);
    }
}
