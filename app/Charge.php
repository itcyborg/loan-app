<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Charge extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
}
