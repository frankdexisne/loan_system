<?php

namespace App\Web\Relationships;

use App\Http\Controllers\BaseCrudController;
use Illuminate\Support\Facades\View;
use App\Models\DBLoans\Relationship;
use Illuminate\Validation\Rule;

class RelationshipsController extends BaseCrudController
{
    public function __construct(Relationship $model){
        $this->module = 'relationships';

        $this->model = $model;

        $this->rules = [
                'name' => [
                    'required',
                    Rule::unique('mysql.relationships')->ignore(request('id'), 'id')
                ]
            ];

        $this->modelQuery = $model;

        View::share([
            'module' => $this->module
        ]);
    }
}
