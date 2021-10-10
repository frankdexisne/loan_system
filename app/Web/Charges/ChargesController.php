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

        if (request('loan_id')) {

        }

        $select = request('loan_id') ? ['charges.*', 'loan_charges.amount', 'loan_charges.id AS loan_charge_id'] : ['charges.*'];

        $this->modelQuery = $model->when(request('loan_id'), function ($query) {
            $query->leftJoin('dbloans.loan_charges', function ($query) {
                $query->on('loan_charges.charge_id', '=', 'charges.id')
                    ->where('loan_id', request('loan_id'));
            });
        })
        ->select($select);

        View::share([
            'module' => $this->module
        ]);
    }
}
