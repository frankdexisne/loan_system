<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $connection = 'dbsystem';

    protected $fillable=[
        'name',
        'display_name',
        'guard_name',
        'module_id'
    ];
}
