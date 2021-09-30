<?php

namespace App\Models\DBLoans;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    use HasFactory;

    protected $connection = 'mysql';

    protected $fillable = ['client_id','transaction_id','reference_no','withdraw_date','amount'];

    protected $appends = ['withdraw_date_formatted'];

    public function getWithdrawDateFormattedAttribute(){
        return date('m/d/Y',strtotime($this->withdraw_date));
    }

    public function transaction(){
        return $this->belongsTo('App\Models\DBLoans\Transaction');
    }

    public function client(){
        return $this->belongsTo('App\Models\DBLoans\Client');
    }

}
