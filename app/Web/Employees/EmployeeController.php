<?php

namespace App\Web\Employees;

use App\Models\DBPayroll\Employee;
use App\Models\DBPayroll\JobTitle;
use App\Models\DBLoans\Branch;
use App\Models\User;
use App\Http\Controllers\BaseCrudController;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class EmployeeController extends BaseCrudController
{
    public function __construct(Employee $model){
        $this->module = 'employees';

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
                'job_title_id' => [
                    'required',
                    'exists:dbpayroll.job_titles,id'
                ]

            ];

        $this->modelQuery = $model->with('job_title');

        View::share([
            'module' => $this->module,
            'job_titles' => JobTitle::get()
        ]);
    }

    protected function appendOnStore($request){
        return [
            'avatar' => 'avatar_2x.png',
            'employee_no' => 'EMP-'.Str::random(10),
            'branch_id' => Branch::firstWhere(['name'=>'Main Branch'])->id
        ];
    }

    public function addAsUser(Employee $employee){
        $user = User::create([
            'name' => $employee->full_name,
            'email' => strtolower($employee->fname[0].$employee->mname[0].$employee->lname).'@loansystem.com',
            'password' => bcrypt('123456')
        ]);
        $employee->update([
            'user_id'=>$user->id
        ]);
    }
}
