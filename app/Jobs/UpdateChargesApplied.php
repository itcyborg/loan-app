<?php

namespace App\Jobs;

use App\ChargeIncome;
use App\LoanApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateChargesApplied implements ShouldQueue
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
        $applications=LoanApplication::where('status','DISBURSED')->orWhere('status','SETTLED')->get();
        $chargesTotal=0;
        $charges=[];

        // get the charges
        foreach ($applications as $application) {
            $this->sumCharges($application->charges_config, $application->amount_approved);
        }
    }

    private function sumCharges($charges,$amount_approved){
        $amount=0;
        if($charges) {
            foreach ($charges as $charge) {
                if ($charge['type'] == 'PERCENTAGE') {
                    $charge_amount = $amount_approved * $charge['amount'] / 100;
                } else {
                    $charge_amount = $charge['amount'];
                }
                $data=[
                    'product_id'=>$charge['product_id'],
                    'charge_name'=>$charge['name'],
                    'amount'=>$charge_amount
                ];
                ChargeIncome::create($data);
            }
        }
        return $amount;
    }
}
