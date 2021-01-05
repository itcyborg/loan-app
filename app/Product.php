<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use OwenIt\Auditing\Contracts\Auditable;

class Product extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $fillable=[
        'log_id',
        'name',
        'code',
        'min_amount',
        'max_amount',
        'rate',
        'min_duration',
        'max_duration',
        'security',
        'status'
    ];


    protected $casts = [
        'created_at' => 'datetime:F j, Y, g:i a',
    ];

    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->log_id = (string) Str::uuid();
        });
    }
}
