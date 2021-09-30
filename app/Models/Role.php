<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $connection = 'dbsystem';

    protected $fillable=[
        'name',
        'guard_name'
    ];

    public function permission(){
        return $this->belongsToMany(Permission::class,'role_has_permissions');
    }


}
