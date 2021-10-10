<?php

namespace App\Web\Withdraws;

use App\Models\DBLoans\Withdraw;
use App\Http\Controllers\BaseCrudController;
use Illuminate\Support\Facades\View;

class WithdrawsController extends BaseCrudController
{
    public function __construct(Withdraw $model){
        $this->module = 'withdraws';

        $this->model = $model;

        $this->search_fields = [
            'reference_no',
            'lname',
            'fname',
            'mname'
        ];

        $this->rules = [
                'reference_no' => [
                    'required',
                    'unique:withdraws'
                ],
                'withdraw_date' => [
                    'required'
                ],
                'amount' => [
                    'required',
                    'numeric'
                ],
                'client_id' => [
                    'required'
                ]
            ];

        $this->modelQuery = $model
                                ->with([
                                    'client'
                                ]);

        View::share([
            'module' => $this->module
        ]);
    }

    protected function filterJsonData(){
        $this->modelQuery = $this->modelQuery
                                    ->when(request('reference_no'), function ($query) {
                                        $query->where('reference_no', request('reference_no'));
                                    })
                                    ->when(request('client_id'), function ($query) {
                                        $query->where('client_id', request('client_id'));
                                    })
                                    ->when(request('name'), function ($query) {
                                        $query->whereHas('client', function ($query) {
                                            $query->where('lname', 'LIKE', '%'. request('name') .'%')
                                                    ->orWhere('fname', 'LIKE', '%'. request('name') .'%')
                                                    ->orWhere('mname', 'LIKE', '%'. request('name') .'%');
                                        });
                                    })
                                    ->limit(20);
    }
}
