<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use OwenIt\Auditing\Contracts\Auditable;

class Repayment extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $fillable=[
        'loan_id',
        'log_id',
        'due_date',
        'amount',
        'amount_paid',
        'amount_default',
        'penalty',
        'interest',
    ];

    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->log_id = (string) Str::uuid();
        });
    }
}
