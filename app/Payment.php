<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * @property mixed loan_application_id
 */
class Payment extends Model
{
    protected $fillable=[
        'loan_application_id',
        'client_id',
        'amount',
        'approved_by',
        'approved_on'
    ];


    protected $casts=[
        'approved_on'=>'date:Y-m-d',
        'created_at'=>'date:Y-m-d',
        'updated_at'=>'date:Y-m-d',
    ];


    protected static function boot()
    {
        parent::boot();
        self::creating(function($payment){
            $payment->approved_on=Carbon::now()->toDateString();
            $payment->approved_by=Auth::id();
        });
    }
}
