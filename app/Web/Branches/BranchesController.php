<?php

namespace App\Web\Branches;

use App\Models\DBLoans\Branch;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;
use App\Http\Controllers\BaseCrudController;

class BranchesController extends BaseCrudController
{
    public function __construct(Branch $model){
        $this->module = 'branches';

        $this->model = $model;

        $this->rules = [
                'name' => [
                    'required',
                    Rule::unique('mysql.branches')->ignore(request('id'), 'id')
                ]
            ];

        $this->modelQuery = $model;

        View::share([
            'module' => $this->module
        ]);
    }
}
