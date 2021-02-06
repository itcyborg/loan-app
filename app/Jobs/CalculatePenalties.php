<?php

namespace App\Jobs;

use App\Repayment;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CalculatePenalties implements ShouldQueue
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
        $repayments=Repayment::whereDate('due_date','<',Carbon::now())->where('status',0)->get();
        $rate=env('penalty_rate',10);
        foreach ($repayments as $repayment) {
            $default=$repayment->amount-$repayment->amount_paid;
            $duration=Carbon::parse($repayment->due_date)->diffInMonths(Carbon::now());
            if($default>0){
                $penalty=$duration*(($rate/100)/12)*$default;
                $repayment->penalty=$penalty;
                $repayment->amount_default=$default;
                $repayment->save();
            }
        }
        CalculateTotalRepayment::dispatch();
    }
}
