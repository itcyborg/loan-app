<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repayment extends Model
{
    protected $fillable=[
        'loan_application_id',
        'amount',
        'client_id'
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
