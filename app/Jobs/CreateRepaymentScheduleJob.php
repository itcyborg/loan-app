<?php

namespace App\Jobs;

use App\Repayment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class CreateRepaymentScheduleJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $loan;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($loan)
    {
        $this->loan = $loan;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // generate schedules
        $duedate=$this->loan->disbursement_date;
        for ($i=0; $i<$this->loan->duration; $i++){
            $amount=$this->loan->amount_approved/$this->loan->duration;
            $duedate=Carbon::parse($duedate)->addMonth();
            Repayment::create([
                'loan_id'=>$this->loan->id,
                'amount'=>(int) $amount,
                'due_date'=>$duedate,
                'interest'=>2
            ]);
        }
    }
}
