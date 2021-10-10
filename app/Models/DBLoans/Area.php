<?php

namespace App\Models\DBLoans;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $connection = 'mysql';

    protected $fillable = [
        'branch_id',
        'name'
    ];

    protected $appends = [
        'display_name'
    ];

    public function getDisplayNameAttribute(){
        $type = $this->for_daily_areas == 1 ? 'daily' : 'weekly';
        return $this->name." (".$type.")";
    }

    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    public function reimbursement(){
        return $this->hasMany(App\Models\DBLoans\Reimbursement::class);
    }

    public function client(){
        return $this->hasMany(App\Models\DBLoans\Client::class);
    }
}
