<?php

namespace App\Web\CoMakers;

use App\Models\DBLoans\CoMaker;
use App\Http\Controllers\BaseCrudController;

class CoMakersController extends BaseCrudController
{
    public function __construct(CoMaker $model){
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
            'dob' => [
                'required',
                'date'
            ],
            'gender' => [
                'required'
            ],
            'contact_no' => [
                'required'
            ],
            'company' => [
                'required'
            ],
            'position' => [
                'required'
            ],
            'monthly_salary' => [
                'required',
                'numeric'
            ]

        ];

        $this->modelQuery = $model;

    }

}
