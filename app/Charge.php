<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use OwenIt\Auditing\Contracts\Auditable;

class Charge extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $fillable=[
        'name',
        'log_id',
        'amount',
        'type',
        'product_id',
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

    public function product()
    {
      return $this->belongsTo(Product::class);
    }
}
