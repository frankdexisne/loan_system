<?php

namespace App\Web\Loans;

use App\Models\DBLoans\Client;
use App\Models\DBLoans\CoMaker;
use App\Models\DBLoans\Loan;
use App\Models\DBLoans\Charge;
use App\Models\DBLoans\Area;
use App\Models\DBLoans\Category;
use App\Models\DBLoans\Term;
use App\Models\DBLoans\Relationship;
use App\Models\DBLoans\Status;
use App\Models\PhilippineCity;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\LoanRegistrationRequest;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\BaseCrudController;
use App\Jobs\UpdatePaymentStatus;
use Carbon\Carbon;

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
                                ->leftJoin('clients','loans.client_id','=','clients.id')
                                ->select(['loans.*']);

        View::share([
            'module' => $this->module,
            'categories' => Category::get(),
            'terms' => Term::orderBy('no_of_months')->get(),
            'areas' => Area::get(),
            'relationships' => Relationship::get(),
            'cities' => PhilippineCity::where('province_code','0505')->with(['philippine_barangay'=>function($query){ $query->orderBy('barangay_description'); }])->orderBy('city_municipality_code')->get()
        ]);
    }

    protected function filterJsonData(){
        $this->modelQuery = $this->modelQuery
                                    ->where('payment_mode_id', request('payment_mode_id'))
                                    ->when(request('name'), function ($query) {
                                        $query->whereHas('client', function ($query) {
                                            $query->where('lname', 'LIKE', '%'. request('name') .'%')
                                                  ->orWhere('fname', 'LIKE', '%'. request('name') .'%')
                                                  ->orWhere('mname', 'LIKE', '%'. request('name') .'%');
                                        });
                                    })
                                    ->when(request('status'), function($query){
                                        $query->whereHas('status', function($query){
                                            $query->where('name', request('status'));
                                        });
                                    })
                                    ->limit(20);
    }

    public function newClient(LoanRegistrationRequest $request){

        if(Client::where(['lname'=>$request->client['lname'], 'fname'=>$request->client['fname'], 'mname'=>$request->client['mname']])->count() > 0){
            return response()->json([
                    'message' => 'Invalid inputs',
                    'errors' => [
                        'lname' => ['Client name is already taken']
                    ]
                ], 422);
        }
        $data = $request->all();

        $client = Client::create($data['client']);
        $client->address()->create($data['address']);
        $client->beneficiary()->create($data['beneficiary']);
        $data['loan']['status_id']=2;
        $data['loan']['payment_mode_id']= Term::firstWhere('id',$data['loan']['term_id'])->daily_only === 1 ? 1 : 2;
        $client->loan()->create($data['loan']);

        $coMaker = CoMaker::firstOrNew([
            'lname' => $data['co_maker']['lname'],
            'fname' => $data['co_maker']['fname'],
            'mname' => $data['co_maker']['mname'],
        ]);

        if(!$coMaker->exists){
            $coMaker->fill([
                'dob'=>$data['co_maker']['dob'],
                'gender' => $data['co_maker']['gender'],
                'contact_no' => $data['co_maker']['contact_no'],
                'company' => $data['co_maker']['company'],
                'position'=>$data['co_maker']['position'],
                'monthly_salary' => $data['co_maker']['monthly_salary']
            ])
            ->save();
        }

        $coMaker->co_maker_address()->create($data['co_maker_address']);

        $client->co_maker()->attach([$coMaker->id]);
    }

    private function getStatusId($status)
    {
        return Status::firstWhere('name', $status)->id;
    }

    public function for_approval(){
        return view($this->module.'.for_approval');
    }

    public function commitApproval($type){
        $statusName = $type == 'approve' ? 'APPROVED' : 'DENIED';
        Loan::whereIn('id',request('id'))->update([
            'status_id' => $this->getStatusId($statusName)
        ]);
        return response(null)->setStatusCode(204);
    }

    public function approved(){
        return view($this->module.'.approved');
    }

    public function moveToForRelease(Loan $loan)
    {
        $field = request('status') === 'APPROVED' ? 'to_release_at' : 'date_release';
        $toStatus = request('status') === 'APPROVED' ? 'FOR RELEASE' : 'RELEASED';
        $loan->update([
            $field => Carbon::parse(request($field)),
            'first_payment' => Carbon::parse(request('first_payment')),
            'status_id' => $this->getStatusId($toStatus),
            'loan_amount_with_interest' => $loan->loan_amount + ($loan->loan_amount * ($loan->interest/100)),
        ]);

        if ($toStatus === 'RELEASED') {
            $loan->update([
                'balance' => $loan->loan_amount + ($loan->loan_amount * ($loan->interest/100)),
            ]);
        }
        $this->generateSchedules($loan->id);

        return $loan;
    }

    public function for_releasing()
    {
        return view($this->module.'.for_releasing');
    }

    public function commitInclude(Loan $loan, string $action)
    {
        if ($action === 'included')
        {
            $loan->update([
                'included_at' => now()
            ]);
        } else {
            $loan->update([
                'included_at' => null
            ]);
        }

        return response(null)->setStatusCode(204);
    }

    public function released()
    {
        return view($this->module.'.released');
    }

    protected function generateSchedules($loanId)
    {
        $loan = Loan::where(['id'=>$loanId])->with('term')->first();

        if ($loan) {
            if ($loan->payment_mode_id === 2) {
                if ($loan->schedule()->count() > 0) {
                    $loan->schedule()->delete();
                }

                $loop = $loan->term->no_of_months * 4;

                $index = 0;
                $schedules = [];
                $date = Carbon::parse($loan->first_payment);

                while ($index < $loop) {
                    array_push( $schedules, [
                        'loan_id' => $loan->id,
                        'schedule_date' => $date->format('Y-m-d'),
                        'progress' => 0,
                    ]);

                    $date = $date->addDays(7);
                    $index+=1;
                }

                $loan->schedule()->insert($schedules);
                if ($this->getStatusId('RELEASED') == $loan->status_id)
                {
                    (new UpdatePaymentStatus($loanId))->handle();
                }

            }
        }
    }

    public function commitCharge(Loan $loan, Charge $charge, String $type)
    {
        $amount = $charge->is_percent === 1 ? $loan->loan_amount * ($charge->value/100) : $charge->value;
        if ($type === 'added') {
            $loan->charge()->attach([$charge->id=>['amount' => $amount, 'created_at' => now(), 'updated_at' => now()]]);
        } else {
            $loan->charge()->detach([$charge->id]);
        }

        return response(null)->setStatusCode(204);
    }

    public function chargeChangeAmount($loanChargeId)
    {
        DB::table('loan_charges')
            ->where('id', $loanChargeId)
            ->update([
                'amount' => request('amount')
            ]);
        return response(null)->setStatusCode(204);
    }

    public function commitByOut(Loan $loan, int $byOutOf, String $type)
    {
        if ($type === 'added') {
            $loan->update(['byout_of' => $byOutOf]);
        } else {
            $loan->update(['byout_of' => null]);
        }
    }

    public function voucher()
    {

    }
}
