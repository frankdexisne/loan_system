<?php

namespace App\Models\DBLoans;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoMakerAddress extends Model
{
    use HasFactory;

    protected $connection = 'mysql';

    protected $fillable = [
        'co_maker_id',
        'philippine_barangay_id',
        'street'
    ];

    public function philippine_barangay(){
        return $this->belongsTo(App\Models\PhilippineBarangay::class);
    }
}
