<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NextOfKin extends Model
{
    protected $table='next_ofkins';
    protected $fillable=[
        'client_id',
        'name',
        'identification_document',
        'identification_number',
        'relation',
        'nationality',
        'date_of_birth',
        'title',
        'gender',
        'primary_contact',
        'alternative_contact',
        'address',
        'loan_applications_id'
    ];
}
