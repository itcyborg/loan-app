<?php

namespace App;

use App\Jobs\CalculatePenalties;
use Illuminate\Database\Eloquent\Model;
use Znck\Eloquent\Traits\BelongsToThrough;

/**
 * @property mixed amount_paid
 */
class Repayment extends Model
{
    use BelongsToThrough;
    protected $fillable=[
        'loan_application_id',
        'amount',
        'amount_paid',
        'client_id',
        'due_date',
        'amount_default',
        'penalty',
        'interest',
        'total_to_pay'
    ];

    protected $casts=[
        'created_at' => 'datetime:F j, Y',
        'updated_at' => 'datetime:F j, Y',
        'due_date' => 'datetime:F j, Y',
    ];

    public function client()
    {
        return $this->belongsToThrough(Clients::class,LoanApplication::class);
    }

    public function loan_application()
    {
        return $this->belongsTo(LoanApplication::class);
    }

    public function product()
    {
        return $this->belongsToThrough('App\Product','App\LoanApplication');
    }

    protected static function boot()
    {
        parent::boot();
        self::updated(function(){
            CalculatePenalties::dispatchAfterResponse();
        });
    }
}
