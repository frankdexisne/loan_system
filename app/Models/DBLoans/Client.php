<?php

namespace App\Models\DBLoans;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Bavix\Wallet\Traits\HasWallet;
use Bavix\Wallet\Traits\HasWallets;
use Bavix\Wallet\Interfaces\Wallet;

class Client extends Model
{
    use HasFactory,HasWallet, HasWallets;

    protected $connection = 'mysql';

    protected $fillable = [
        'pn_number',
        'account_no',
        'lname',
        'fname',
        'mname',
        'dob',
        'gender',
        'contact_no',
        'company',
        'position',
        'monthly_salary',
        'area_id'
    ];

    protected $appends = [
        'personal_saving',
        'capital_build_up',
        'loan_balance',
        'full_address',
        'full_name'
    ];

    protected $cast = [
        'dob' => 'date'
    ];

    public function address(){
        return $this->hasOne(Address::class);
    }

    public function area(){
        return $this->belongsTo(Area::class);
    }

    public function beneficiary(){
        return $this->hasOne(Beneficiary::class);
    }

    public function co_maker(){
        return $this->belongsToMany(CoMaker::class,'client_co_makers');
    }

    public function getPersonalSavingAttribute(){
        return $this->hasWallet('ps') ? $this->getWallet('ps')->balance : 0;
    }

    public function getCapitalBuildUpAttribute(){
        return $this->hasWallet('cbu') ? $this->getWallet('cbu')->balance : 0;
    }

    public function getFullNameAttribute(){
        return $this->lname.', '.$this->fname.' '.$this->mname;
    }

    public function getFullAddressAttribute(){
        return $this->address==null ? null : $this->address->street.' '.$this->address->philippine_barangay->barangay_description.', '.$this->address->philippine_barangay->philippine_city->city_municipality_description.', '.$this->address->philippine_barangay->philippine_province->province_description;
    }

    public function loan(){
        return $this->hasMany(Loan::class);
    }

    public function in_process_loan(){
        return $this->loan()->where('status_id','<',6)->orderBy('date_loan','DESC');
    }

    public function active_loan(){
        return $this->loan()->where('status_id',6)->orderBy('date_loan','DESC');
    }

    public function getLoanBalanceAttribute(){
        return $this->active_loan()->sum('balance');
    }

    public function inactive_loan(){
        return $this->loan()->where('status_id',7)->orderBy('date_loan','DESC');
    }

    public function deposit(){
        return $this->hasMany(Payment::class)->whereNull('loan_id')->orderBy('payment_date','DESC');
    }

    public function withdraw(){
        return $this->hasMany(Withdraw::class);
    }


}
