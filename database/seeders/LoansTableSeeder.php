<?php

namespace Database\Seeders;

use App\Models\DBLoans\Loan;
use Illuminate\Database\Seeder;

class LoansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $loans = Loan::orderBy('date_loan')
                    ->orderBy('client_id')
                    ->get()
                    ->makeHidden([
                        'date_loan_formatted',
                        'date_release_formatted',
                        'first_payment_formatted',
                        'maturity_date_formatted',
                        'loan_amount_formatted',
                        'balance_formatted',
                        'deduction_formatted',
                        'ps_formatted',
                        'cbu_formatted',
                        'total_byout_formatted',
                        'created_at',
                        'updated_at'
                    ])
                    ->toArray();

        $collections = collect($loans)->map(function ($item) {

        })
        ->toArray();

        Loan::upsert($collections,['client_id', 'transaction_code'],['cycle']);
    }
}
