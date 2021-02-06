<?php

namespace App\Jobs;

use App\LoanApplication;
use App\Payment;
use App\Repayment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CalculateRefunds implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $applications=LoanApplication::where('status','DISBURSED')->get();
        foreach ($applications as $application) {
            $repayments=Repayment::where('loan_application_id',$application->id)->get();
            $total_repayments=$repayments->sum('amount_paid');
            $total_amount_due=$repayments->sum('total_to_pay');
            $total_payments_made=Payment::where('loan_application_id',$application->id)->sum('amount');

            // check if total amount paid is equal to or more than amount due
            if($total_payments_made>=$total_amount_due){
                $overpayment=$total_payments_made-$total_amount_due;
                $application->overpayment=$overpayment;
                $application->status='SETTLED';
                $application->save();

            }
        }
    }
}
