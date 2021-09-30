<?php

namespace App\Models\DBLoans;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $connection = 'mysql';

    protected $fillable = [
        'client_id',
        'category_id',
        'term_id',
        'payment_mode_id',
        'status_id',
        'transaction_code',
        'date_loan',
        'date_release',
        'transaction_id',
        'to_release_at',
        'first_payment',
        'maturity_date',
        'last_payment_date',
        'loan_amount',
        'interest',
        'settled',
        'balance',
        'over',
        'payment_per_sched',
        'byout_of',
        'is_renew'
    ];

    protected $appends = [
        'date_loan_formatted',
        'date_release_formatted',
        'first_payment_formatted',
        'maturity_date_formatted',
        'loan_amount_formatted',
        'balance_formatted',
        'deduction_formatted',
        'ps_formatted',
        'cbu_formatted',
        'total_byout_formatted'
    ];

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function term(){
        return $this->belongsTo(Term::class);
    }

    public function payment_mode(){
        return $this->belongsTo(PaymentMode::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }

    public function payment(){
        return $this->hasMany(Payment::class);
    }

    public function schedule(){
        return $this->hasMany(Schedule::class);
    }

    public function charge(){
        return $this->belongsToMany(Charge::class,'loan_charges');
    }

    public function loan_charge(){
        return $this->hasMany(LoanCharge::class,'loan_id','id');
    }

    public function byout(){
        return $this->hasMany(Loan::class,'byout_of','id');
    }

    public function ps(){
        return $this->hasOne(Transaction::class,'id','ps_id');
    }

    public function cbu(){
        return $this->hasOne(Transaction::class,'id','cbu_id');
    }

    public function getTotalByoutFormattedAttribute(){
        return number_format($this->byout->sum('balance'),2,'.',',');
    }


    public function getPsFormattedAttribute(){
        $amount = $this->ps!=null ? $this->ps->amount : 0;
        return number_format($amount,2,'.',',');
    }

    public function getCbuFormattedAttribute(){
        $amount = $this->cbu!=null ? $this->cbu->amount : 0;
        return number_format($amount,2,'.',',');
    }


    public function getDeductionFormattedAttribute(){
        return number_format($this->loan_charge->sum('amount'),2,'.',',');
    }

    public function getDateLoanFormattedAttribute(){
        return date('m/d/Y',strtotime($this->date_loan));
    }

    public function getFirstPaymentFormattedAttribute(){
        return $this->first_payment!=null ? date('m/d/Y',strtotime($this->first_payment)) : '';
    }

    public function getMaturityDateFormattedAttribute(){
        return $this->maturity_date!=null ? date('m/d/Y',strtotime($this->maturity_date)) : '';
    }

    public function getDateReleaseFormattedAttribute(){
        return $this->date_release!=null ? date('m/d/Y',strtotime($this->date_release)) : '';
    }

    public function getLoanAmountFormattedAttribute(){
        return number_format($this->loan_amount,2,'.',',');
    }

    public function getBalanceFormattedAttribute(){
        return number_format($this->balance,2,'.',',');
    }

    public function scopeStatus($query, $statusName){
        $query->whereHas('status', function($q) use($statusName){
            $q->where('name', $statusName);
        });
    }

}
