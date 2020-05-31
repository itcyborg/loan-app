<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoanApplication extends Model
{
    protected $fillable=[
        'client_id',
        'amount_applied',
        'amount_approved',
        'total_interest',
        'charges',
        'status',
        'rate',
        'duration',
        'due_date',
        'purpose',
        'user_id',
        'repayment_frequency',
        'product_id',
        'approval_date',
        'disbursement_date'
    ];

    protected $casts=[
        'charges'=>'json'
    ];
}
