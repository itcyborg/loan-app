<?php

namespace App\Jobs;

use App\ChargeIncome;
use App\LoanApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CalculateChargesIncome implements ShouldQueue
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
        $applications=LoanApplication::whereIn('status',['DISBURSED','SETTLED','APPROVED'])->get();
        $data=[];

        foreach ($applications as $application) {
            $charges=$application['charges_config'];
            foreach ($charges as $charge) {
                $amount=0;
                if($charge['type']=='PERCENTAGE'){
                    $amount=$charge['amount']*$application['amount_approved']/100;
                }else{
                    $amount=$charge['amount'];
                }
                $data[]=[
                    'charge_name'=>$charge['name'],
                    'amount'=>$amount,
                    'product_id'=>$charge['product_id']
                ];
            }
        }
        ChargeIncome::truncate();
        foreach ($data as $datum){
            ChargeIncome::create($datum);
        }
    }
}
