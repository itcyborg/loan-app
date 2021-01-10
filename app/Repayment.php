<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repayment extends Model
{
    protected $fillable=[
        'loan_application_id',
        'amount',
        'amount_paid',
        'client_id',
        'due_date',
        'amount_default',
        'penalty',
        'interest'
    ];

    protected $casts=[
        'created_at' => 'datetime:F j, Y',
        'due_date' => 'datetime:F j, Y'
    ];

    public function client()
    {
        return $this->belongsTo(Clients::class);
    }

    public function loan_application()
    {
        return $this->belongsTo(LoanApplication::class);
    }
}
