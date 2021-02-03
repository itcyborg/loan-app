<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Clients extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
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

    protected $casts=[
        'date_of_birth'=>'date:Y-m-d',
        'created_at'=>'date:Y-m-d',
        'updated_at'=>'date:Y-m-d',
    ];
}
