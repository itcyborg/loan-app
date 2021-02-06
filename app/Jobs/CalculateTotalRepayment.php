<?php

namespace App\Jobs;

use App\Repayment;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CalculateTotalRepayment implements ShouldQueue
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
        print('Running totals'.PHP_EOL);
        $repayments=Repayment::where('status',0)->get();
        foreach ($repayments as $repayment) {
            if(Carbon::parse($repayment->due_date)->isPast()){
                $default=$repayment->amount-$repayment->amount_paid;
                $repayment->amount_default=$default;

                $repayment->total_to_pay=$repayment->amount_default+$repayment->penalty;
//                $repayment->total_to_pay=($repayment->amount-$default)+$repayment->penalty-$repayment->amount_paid;
            }else{
                $repayment->total_to_pay=$repayment->amount;
            }
            $repayment->save();
        }
    }
}
