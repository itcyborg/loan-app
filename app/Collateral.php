<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Collateral extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;
}
