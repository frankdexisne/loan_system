<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workstation extends Model
{
    use HasFactory;

    protected $connection = 'dbsystem';

    protected $fillable = [
        'workstation_name',
        'workstation_description',
        'encrypted_ws',
        'branch_id',
        'allowed'
    ];

    public function branch(){
        return $this->belongsTo(Branch::class);
    }
}
