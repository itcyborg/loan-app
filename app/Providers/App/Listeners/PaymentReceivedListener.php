<?php

namespace App\Providers\App\Listeners;

use App\Payment;
use App\Providers\App\Events\PaymentReceivedEvent;
use App\Repayment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PaymentReceivedListener
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  PaymentReceivedEvent  $event
     * @return void
     */
    public function handle(PaymentReceivedEvent $event)
    {
        $payment =$event->payment;
        $schedules =Repayment::where('loan_application_id', $payment->loan_application_id)->where('status',0)->orderBy('due_date','asc')->get();
        foreach ($schedules as $schedule) {
            $total_amount=$schedule->amount_paid+$payment->amount;
            $payment->amount=$total_amount;
            if($payment->amount>0) {
                if ($payment->amount > $schedule->total_to_pay) {
                    $schedule->amount_paid=$schedule->total_to_pay;
                    $payment->amount=($payment->amount-$schedule->total_to_pay);
                    $schedule->status=1;
                }elseif ($payment->amount == $schedule->total_to_pay) {
                    $schedule->amount_paid=$schedule->total_to_pay;
                    $schedule->status=1;
                }else{
                    $schedule->amount_paid=$payment->amount;
                    $payment->amount=0;
                    $schedule->status=0;
                }
                $schedule->save();
            }
        }
    }
}
