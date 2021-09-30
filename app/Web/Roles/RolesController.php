<?php

namespace App\Web\Roles;

use App\Http\Controllers\BaseCrudController;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
// use App\Models\Role;
use Spatie\Permission\Models\Role;
use App\Models\Permission;
class RolesController extends BaseCrudController
{
    public function __construct(Role $model){
        $this->module = 'roles';

        $this->model = $model;

        $this->rules = [
                'name' => [
                    'required',
                    Rule::unique('dbsystem.roles')->ignore(request('id'), 'id')
                ]
            ];

        $this->modelQuery = $model;

        View::share([
            'module' => $this->module
        ]);
    }

    public function assignPermissions(Role $role){
        if(request()->boolean('granted')==true){
            $role->givePermissionTo(request('name'));
        }else{
            $role->revokePermissionTo(request('name'));
        }
    }

    public function getPermissions(Role $role){

        return [
            'data'=>Permission::leftJoin('dbsystem.role_has_permissions',function($query) use($role){
                $query->on('dbsystem.permissions.id','=','dbsystem.role_has_permissions.permission_id')
                      ->where('role_id', $role->id);
            })
            ->select([
                'dbsystem.permissions.*',
                DB::raw('IF(dbsystem.role_has_permissions.permission_id IS NULL, 0, 1) AS has_permission')
            ])
            ->get()
        ];
    }
}
