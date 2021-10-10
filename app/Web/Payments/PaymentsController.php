<?php

namespace App\Web\Payments;

use App\Models\DBLoans\Payment;
use App\Models\DBLoans\Client;
use App\Models\DBLoans\Loan;
use App\Http\Controllers\BaseCrudController;
use Illuminate\Support\Facades\View;

class PaymentsController extends BaseCrudController
{
    public function __construct(Payment $model){
        $this->module = 'payments';

        $this->model = $model;

        $this->search_fields = [
            'orno',
            'lname',
            'fname',
            'mname'
        ];

        $this->rules = [
                'orno' => [
                    'required',
                    'unique:payments'
                ],
                'payment_date' => [
                    'required'
                ],
                'amount' => [
                    'required',
                    'numeric'
                ],
                'ps' => [
                    'required',
                    'numeric'
                ],
                'cbu' => [
                    'required',
                    'numeric'
                ]
            ];
        $this->modelQuery = $model
                                ->with([
                                    'client',
                                    'loan' => function($query) { $query->with(['client', 'category', 'term']); },
                                    'ps',
                                    'cbu'
                                ]);

        View::share([
            'module' => $this->module
        ]);
    }

    protected function appendOnStore($request)
    {
        $clientId=null;

        if ($request->has('client_id')) {
            $clientId = request('client_id');
        } else {
            $clientId = Loan::where('id', request('loan_id'))->first()->client_id;
        }

        $ps_id = $this->depositSavings($clientId, ['name' => 'ps', 'slug' => 'PERSONAL SAVINGS'], $request->amount);
        $cbu_id = $this->depositSavings($clientId, ['name' => 'cbu', 'slug' => 'CAPITAL BUILD UP'], $request->amount);

        return [
            'ps_id' => $ps_id,
            'cbu_id' => $cbu_id
        ];
    }

    private function depositSavings($clientId, $wallet = [], $amount)
    {
        $id = null;
        $client = Client::where('id', $clientId)->first();
        if ($client) {
            if ($client->hasWallet($wallet['name'])) {
                $client->createWallet($wallet);
            }

            $wallet = $client->getWallet($wallet['name']);

            $id = $wallet->deposit($amount);
        }
        return $id;
    }

    protected function filterJsonData(){
        $this->modelQuery = $this->modelQuery
                                    ->when(request('orno'), function ($query) {
                                        $query->where('orno', request('orno'));
                                    })
                                    ->when(request('payment_mode_id'), function($query) {
                                        $query->whereNotNull('loan_id');
                                    })
                                    ->when(request('loan_id'), function ($query) {
                                        $query->where('loan_id', request('loan_id'));
                                    })
                                    ->when(request('client_id'), function ($query) {
                                        $query->where('client_id', request('client_id'));
                                    })
                                    ->when(request('name'), function ($query) {
                                        // if(request('client_id')){
                                        //     $query->whereHas('client', function ($query) {
                                        //         $query->where('lname', 'LIKE', '%'. request('name') .'%')
                                        //               ->orWhere('fname', 'LIKE', '%'. request('name') .'%')
                                        //               ->orWhere('mname', 'LIKE', '%'. request('name') .'%');
                                        //     });
                                        // }

                                            $query->whereHas('loan', function ($query) {
                                                $query->whereHas('client', function ($query) {
                                                    $query->where('lname', 'LIKE', '%'. request('name') .'%')
                                                          ->orWhere('fname', 'LIKE', '%'. request('name') .'%')
                                                          ->orWhere('mname', 'LIKE', '%'. request('name') .'%');
                                                });
                                            });


                                    })
                                    ->limit(20);
    }
}
