<?php

namespace App\Models\DBLoans;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $connection = 'mysql';

    protected $fillable = [
        'name'
    ];

    protected $guarded = ['id'];

    public function loan(){
        return $this->hasMany(Loan::class);
    }

}
