<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Referee extends Model
{
    protected $fillable=[
        'name',
        'nationality',
        'contact',
        'alternate_contact',
        'location',
        'loan_id'
    ];
}
