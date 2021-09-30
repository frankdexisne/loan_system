<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhilippineRegion extends Model
{
    use HasFactory;

    protected $connection = 'dbsystem';

    public function philippine_province(){
        return $this->hasMany(PhilippineProvince::class,'region_code','region_code');
    }

}
