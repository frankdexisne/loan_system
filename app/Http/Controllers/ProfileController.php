<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;

class ProfileController extends BaseCrudController
{

    public function __construct(User $model)
    {
        $this->module = 'profile';

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
            'module' => $this->module
        ]);

    }

    public function profile(User $user){
        if($user->id !== auth()->user()->id) abort(404);
        return view('profile', compact('user'));
    }
}
