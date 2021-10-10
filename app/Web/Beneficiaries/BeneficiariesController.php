<?php

namespace App\Web\Beneficiaries;

use App\Models\DBLoans\Beneficiary;
use App\Http\Controllers\BaseCrudController;

class BeneficiariesController extends BaseCrudController
{
    public function __construct(Beneficiary $model){
        $this->model = $model;

        $this->rules = [
            'lname' => [
                'required'
            ],
            'fname' => [
                'required'
            ],
            'mname' => [
                'required'
            ],
            'gender' => [
                'required'
            ],
            'relationship_id' => [
                'required'
            ]
        ];

        $this->modelQuery = $model;

    }
}
