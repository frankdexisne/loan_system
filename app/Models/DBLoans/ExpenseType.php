<?php

namespace App\Models\DBLoans;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseType extends Model
{
    use HasFactory;

    protected $connection = 'mysql';

    protected $fillable = [
        'name'
    ];

    public function expense(){
        return $this->hasMany(Expense::class);
    }
}
