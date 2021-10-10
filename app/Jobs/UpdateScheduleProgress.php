<?php

namespace App\Jobs;

use App\Models\DBLoans\Schedule;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateScheduleProgress implements ShouldQueue
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
        // $collection = Schedule::when($this->loanId, function ($query) {
        //     $query->where('loan_id', $this->loanId);
        // })
        // ->chunkByLoanId(fu)
    }
}
