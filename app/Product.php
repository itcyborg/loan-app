<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable=[
        'name',
        'code',
        'min_amount',
        'max_amount',
        'rate',
        'min_duration',
        'max_duration',
        'security',
        'charges'
    ];

    protected $casts=[
        'charges'=>'json'
    ];
}
