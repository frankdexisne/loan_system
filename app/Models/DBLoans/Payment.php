<?php

namespace App\Models\DBLoans;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $connection = 'mysql';

    protected $fillable = [
        'client_id',
        'loan_id',
        'reimbursement_id',
        'orno',
        'payment_date',
        'amount',
        'ps_id',
        'cbu_id',
        'ins_id'
    ];

    protected $appends = [
        'payment_date_formatted',
        'amount_formatted',
        'ps_amount',
        'cbu_amount',
        'ins_amount'
    ];

    protected $cast = [
        'payment_date' => 'date',
        'amount' => 'double'
    ];

    public function loan(){
        return $this->belongsTo(Loan::class);
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function ps(){
        return $this->hasOne(Transaction::class,'id','ps_id');
    }

    public function cbu(){
        return $this->hasOne(Transaction::class,'id','cbu_id');
    }

    public function ins(){
        return $this->hasOne(Transaction::class,'id','ins_id');
    }

    public function getPaymentDateFormattedAttribute(){
        return date('m/d/Y',strtotime($this->payment_date));
    }

    public function getAmountFormattedAttribute(){
        return number_format($this->amount,2,'.',',');
    }

    public function getPsAmountAttribute(){
        return $this->ps_id!=null ? $this->ps->amount : 0;
    }

    public function getCbuAmountAttribute(){
        return $this->cbu_id!=null ? $this->cbu->amount : 0;
    }

    public function getInsAmountAttribute(){
        return $this->ins_id!=null ? number_format($this->ins->amount,2,'.',',') : 0;
    }

}
