<?php

namespace App\Web\Expenses;

use App\Models\DBLoans\Expense;
use App\Models\DBLoans\ExpenseType;
use App\Models\DBPayroll\Employee;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\BaseCrudController;

class ExpensesController extends BaseCrudController
{
    public function __construct(Expense $model){
        $this->module = 'expenses';

        $this->model = $model;

        $this->rules = [
                'expense_type_id' => [
                    'required',
                    'exists:mysql.expense_types,id'
                ],
                'expense_date' => [
                    'required',
                    'date'
                ],
                'description' => [
                    'required'
                ],
                'amount'=> [
                    'required',
                    'numeric'
                ]
            ];

        $this->modelQuery = $model->with(['employee','expense_type']);

        View::share([
            'module' => $this->module,
            'expense_types' => ExpenseType::get(),
            'employees' => Employee::get()
        ]);
    }
}
