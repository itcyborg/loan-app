<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use OwenIt\Auditing\Contracts\Auditable;

class Loan extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $fillable=[
        'loan_id',
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
    }
}
