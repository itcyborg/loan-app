<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * @method static where(string $string, string $string1)
 */
class Product extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $fillable=[
        'name',
        'code',
        'min_amount',
        'max_amount',
        'rate',
        'min_duration',
        'max_duration',
        'security',
        'charges'
    ];

    protected $casts=[
        'charges'=>'json'
    ];

    public function charges()
    {
        return $this->hasMany(Charge::class,'product_id','id');
    }
}
