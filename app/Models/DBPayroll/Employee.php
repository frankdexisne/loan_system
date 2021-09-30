<?php

namespace App\Models\DBPayroll;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $connection = 'dbpayroll';

    protected $fillable = [
        'employee_no',
        'avatar',
        'lname',
        'fname',
        'mname',
        'gender',
        'job_title_id',
        'user_id',
        'branch_id'
    ];

    protected $appends = ['full_name'];

    public function job_title(){
        return $this->belongsTo(JobTitle::class);
    }

    public function branch(){
        return $this->belongsTo(App\Models\DBLoans\Branch::class);
    }

    public function user(){
        return $this->belongsTo(App\Models\User::class);
    }

    public function area(){
        return $this->belongsTo(App\Models\DBLoans\Area::class);
    }

    public function getFullNameAttribute(){
        return $this->lname.', '.$this->fname.' '.$this->mname;
    }
}
