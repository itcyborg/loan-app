<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    protected $fillable=[
        'name',
        'email',
        'gender',
        'identification_document',
        'identification_number',
        'primary_contact',
        'alternative_contact',
        'address',
        'date_of_birth',
        'nationality',
    ];
}
