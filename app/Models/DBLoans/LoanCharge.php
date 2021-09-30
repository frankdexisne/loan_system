<?php

namespace App\Models\DBLoans;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanCharge extends Model
{
    use HasFactory;

    protected $connection = 'mysql';


    protected $fillable=[
        'loan_id',
        'charge_id',
        'amount'
    ];

    protected $guarded=[
        'id',
        'created_at',
        'updated_at'
    ];

}
