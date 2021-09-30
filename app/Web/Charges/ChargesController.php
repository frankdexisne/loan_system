<?php

namespace App\Web\Charges;

use App\Models\DBLoans\Charge;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;
use App\Http\Controllers\BaseCrudController;

class ChargesController extends BaseCrudController
{
    public function __construct(Charge $model){
        $this->module = 'charges';

        $this->model = $model;

        $this->rules = [
                'name' => [
                    'required',
                    Rule::unique('mysql.charges')->ignore(request('id'), 'id')
                ]
            ];

        $this->modelQuery = $model;

        View::share([
            'module' => $this->module
        ]);
    }
}
