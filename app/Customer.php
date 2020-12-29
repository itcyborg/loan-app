<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use OwenIt\Auditing\Contracts\Auditable;

class Customer extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $fillable=[
        'log_id',
        'name',
        'email',
        'gender',
        'identification_document',
        'identification_number',
        'primary_contact',
        'alternative_contact',
        'address',
        'longitude',
        'latitude',
        'date_of_birth',
        'nationality',
        'status',
        'agent_id',
    ];

    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->log_id = (string) Str::uuid();
        });
    }
}
