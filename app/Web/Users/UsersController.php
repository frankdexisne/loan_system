<?php

namespace App\Web\Users;

use App\Http\Controllers\BaseCrudController;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Role;

class UsersController extends BaseCrudController
{
    public function __construct(User $model){
        $this->module = 'users';

        $this->model = $model;

        $this->rules = [
                'name' => [
                    'required'
                ],
                'email' => [
                    'required',
                    Rule::unique('dbsystem.users')->ignore(request('id'), 'id')
                ],
                'password' => [
                    'required',
                    'confirmed'
                ]
            ];

        $this->modelQuery = $model->with('roles');

        View::share([
            'module' => $this->module,
            'roles' => Role::get()
        ]);
    }

    protected function appendOnStore($request){
        return [
            'password'=>bcrypt($request->password)
        ];
    }

    public function resetPassword(User $user){
        $user->update([
            'password'=>bcrypt('123456')
        ]);
        return response(null);
    }

    public function assignRole(User $user){
        $user->syncRoles(request('roles'));
    }





}
