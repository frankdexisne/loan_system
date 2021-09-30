<?php

namespace App\Models\DBLoans;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $connection = 'mysql';

    protected $fillable = [
        'client_id',
        'philippine_barangay_id',
        'street'
    ];

    public function philippine_barangay(){
        return $this->belongsTo('App\Models\PhilippineBarangay');
    }
}
