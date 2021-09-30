<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhilippineProvince extends Model
{
    use HasFactory;

    protected $connection = 'dbsystem';

    public function philippine_city(){
        return $this->hasMany(PhilippineCity::class,'province_code','province_code');
    }

    public function philippine_region(){
        return $this->belongsTo(PhilippineRegion::class,'region_code','region_code');
    }

}
