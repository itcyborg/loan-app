<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guarantor extends Model
{
    protected $fillable=[
        'name',
        'application_id',
        'identification_number',
        'identification_document',
        'contact',
    ];
}
