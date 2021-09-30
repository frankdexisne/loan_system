<?php

namespace App\Web\Loans;

use App\Models\DBLoans\Loan;
use App\Models\DBLoans\Category;
use App\Models\DBLoans\Term;
use App\Models\DBLoans\PaymentMode;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\BaseCrudController;

class LoansController extends BaseCrudController
{
    public function __construct(Loan $model){
        $this->module = 'loans';

        $this->model = $model;

        $this->search_fields = [
            'lname',
            'fname',
            'mname'
        ];

        $this->rules = [
                'category_id' => [
                    'required'
                ],
                'term_id' => [
                    'required'
                ],
                'loan_amount' => [
                    'required',
                    'numeric'
                ],
                'interest' => [
                    'required',
                    'numeric'
                ],
                'date_loan' => [
                    'required',
                    'date'
                ]
            ];
        $this->modelQuery = $model
                                ->with([
                                    'client',
                                    'category',
                                    'term',
                                    'payment_mode',
                                    'charge'
                                ])
                                ->leftJoin('clients','loans.client_id','=','clients.id');

        View::share([
            'module' => $this->module,
            'categories' => Category::get(),
            'terms' => Term::orderBy('no_of_months')->get()
        ]);
    }

    protected function filterJsonData(){
        $this->modelQuery = $this->modelQuery
                                    ->where('payment_mode_id', request('payment_mode_id'))
                                    // ->when(request('payment_mode_id'), function($query){
                                    //     $query->where('payment_mode_id', request('payment_mode_id'));
                                    // })
                                    ->when(request('status'), function($query){
                                        $query->whereHas('status', function($query){
                                            $query->where('name', request('status'));
                                        });
                                    });
    }

    public function for_approval(){
        return view($this->module.'.for_approval');
    }

    public function approved(){
        return view($this->module.'.approved');
    }

    public function for_releasing(){
        return view($this->module.'.for_releasing');
    }

    public function released(){
        return view($this->module.'.released');
    }
}
