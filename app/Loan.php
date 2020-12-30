<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use OwenIt\Auditing\Contracts\Auditable;

class Loan extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;
    use LoanHelper;

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
                $model->total_interest =$this->calc($model->amount_approved,$model->rate,$model->duration);
            }
            if($model->status == 'DISBURSED'){
                $model->disbursement_date=Carbon::now()->toDateTimeString();
                $model->due_date=Carbon::now()->addMonths($model->duration)->addMonth();
                $model->disbursed_by=1;
            }
        });

        self::updated(function ($model) {
            if($model->status == 'DISBURSED'){
                $disbursement=$this->disbursement($model);
            }
        });
    }
}
