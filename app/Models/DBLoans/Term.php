<?php

namespace App\Models\DBLoans;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    use HasFactory;

    protected $connection = 'mysql';

    protected $fillable = [
        'no_of_months'
    ];

    protected $appends = [
        'name',
        'payment_mode_id'
    ];

    public function getNameAttribute(){
        return $this->no_of_months.($this->daily_only==1 ? ' days' : ' months');
    }

    public function getPaymentModeIdAttribute(){
        return $this->daily_only==1 ? 1 : 2;
    }
}
