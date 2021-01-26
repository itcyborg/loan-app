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

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
