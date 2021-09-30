<?php

namespace App\Models\DBLoans;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoMaker extends Model
{
    use HasFactory;

    protected $connection = 'mysql';

    protected $fillable = [
        'client_id',
        'lname',
        'fname',
        'mname',
        'dob',
        'gender',
        'contact_no',
        'company',
        'position',
        'monthly_salary'
    ];

    public function co_maker_address(){
        return $this->hasMany(CoMakerAddress::class);
    }
}
