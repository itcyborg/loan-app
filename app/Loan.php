<?php

namespace App;

use App\Jobs\CreateRepaymentScheduleJob;
use App\Notifications\LoanDisbursed;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use OwenIt\Auditing\Contracts\Auditable;

class Loan extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $fillable=[
        'product_id',
        'rate',
        'purpose',
        'amount_applied',
        'amount_approved',
        'total_interest',
        'duration',
        'due_date',
        'approval_date',
        'disbursement_date',
        'repayment_frequency',
        'total_amount_repaid',
        'status',
        'customer_id',
        'loan_officer',
        'applied_by',
        'disbursed_by',
        'product_config',
    ];

    protected $casts=[
        'product_config'=>'json'
    ];

    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->log_id = (string) Str::uuid();
        });

        self::updating(function($model){
            if($model->status == 'APPROVED'){
                $model->total_interest =self::calc($model->amount_approved,$model->rate,$model->duration)->interest;
            }
            if($model->status == 'DISBURSED'){
                $model->disbursement_date=Carbon::now()->toDateTimeString();
                $model->due_date=Carbon::now()->addMonths($model->duration)->addMonth();
                $model->disbursed_by=1;
            }
        });

        self::updated(function ($model) {
            if($model->status == 'DISBURSED'){
                CreateRepaymentScheduleJob::dispatch($model)->onQueue('loan');
                Notification::route('mail', 'taylor@example.com')
                    ->notify(new LoanDisbursed($model));
            }
            if($model->status == 'APPROVED'){
                Notification::route('mail', 'taylor@example.com')
                    ->notify(new LoanDisbursed($model));
            }
            if($model->status == 'REJECTED'){
                Notification::route('mail', 'taylor@example.com')
                    ->notify(new LoanDisbursed($model));
            }
            if($model->status == 'SETTLED'){
                Notification::route('mail', 'taylor@example.com')
                    ->notify(new LoanDisbursed($model));
            }
        });
    }

    protected static function calc($principal, $rate,$term)
    {
        $frequency = 12;
        $rate /= 100;

        // formula to calculate amount: [P(1+(r/n))^(nt)]
        $amount = $principal * ((1 + ($rate / $frequency)) ** ($term));
        $interest = $amount - $principal;
        return json_decode(json_encode(['amount' => $amount, 'interest' => $interest]),false);
    }
}
