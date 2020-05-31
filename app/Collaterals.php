<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collaterals extends Model
{
    protected $fillable=[
        'application_id',
        'type',
        'details',
        'value'
    ];
}
