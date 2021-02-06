<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class NextOfKin extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
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

    public function getAlternativeContactAttribute($value)
    {
        if($value==null){
            return '';
        }
        return $value;
    }
}
