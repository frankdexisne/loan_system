<?php

namespace App\Web\Areas;

use App\Models\DBLoans\Area;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;
use App\Http\Controllers\BaseCrudController;

class AreasController extends BaseCrudController
{
    public function __construct(Area $model){
        $this->module = 'areas';

        $this->model = $model;

        $this->rules = [
                'name' => [
                    'required',
                    Rule::unique('mysql.areas')->ignore(request('id'), 'id')
                ]
            ];

        $this->modelQuery = $model->with('branch');

        View::share([
            'module' => $this->module
        ]);
    }
}
