<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * @method static create(array $all)
 */
class Charge extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable=[
        'name',
        'amount',
        'type',
        'product_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
