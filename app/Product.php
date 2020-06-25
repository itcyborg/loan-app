<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Product extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
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
