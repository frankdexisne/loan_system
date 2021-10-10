<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\DBLoans\Payment;
use App\Models\DBLoans\Loan;
use App\Models\DBLoans\Schedule;
use Illuminate\Support\Facades\DB;

class UpdatePaymentStatus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $loanId;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($loanId = null)
    {
        $this->loanId = $loanId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $collection = Payment::when($this->loanId, function ($query) {
            $query->where('loan_id', $this->loanId);
        })
        ->leftJoin('loans', 'loans.id', '=', 'payments.loan_id')
        ->groupBy('payments.loan_id')
        ->select([
            'loans.id',
            DB::raw('SUM(amount) AS settled'),
            DB::raw('loans.loan_amount_with_interest - SUM(amount) AS balance')
        ])
        ->get()
        ->makeHidden([
            'payment_date_formatted',
            'amount_formatted',
            'ps_amount',
            'cbu_amount',
            'ins_amount'
        ])
        ->toArray();

        Loan::upsert($collection, ['settled', 'balance'], ['id']);

        (new UpdateScheduleProgress())->handle();

        $closed = Loan::where('status_id', 6)
                      ->where('balance', 0);

        if ($closed->count() > 0) {
            $closed->update([
                'status_id' => 7
            ]);
        }


    }
}
