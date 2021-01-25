<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChargeIncome extends Model
{
    protected $fillable=[
        'product_id',
        'charge_name',
        'amount'
    ];
}
