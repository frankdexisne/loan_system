<?php

namespace App\Web\Clients;

use App\Models\DBLoans\Client;
use App\Models\DBLoans\Area;
use App\Models\DBLoans\Relationship;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;
use App\Http\Controllers\BaseCrudController;

class ClientsController extends BaseCrudController
{
    public function __construct(Client $model){
        $this->module = 'clients';

        $this->model = $model;

        $this->search_fields = [
            'lname',
            'fname',
            'mname'
        ];

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
            ],
            'area_id' => [
                'required'
            ]

        ];

        $this->modelQuery = $model;

        View::share([
            'module' => $this->module,
            'areas' => Area::get(),
            'relationships' => Relationship::get()
        ]);
    }

    protected function filterJsonData(){
        $this->modelQuery = $this->modelQuery
                                    ->when(request('name'), function ($query) {

                                        $query->where('lname', 'LIKE', '%'. request('name') .'%')
                                                ->orWhere('fname', 'LIKE', '%'. request('name') .'%')
                                                ->orWhere('mname', 'LIKE', '%'. request('name') .'%');

                                    })
                                    ->with([
                                        'co_maker',
                                        'beneficiary',
                                        'active_loan'
                                    ])
                                    ->limit(20);
    }
}
