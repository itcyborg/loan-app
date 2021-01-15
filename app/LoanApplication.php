<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class LoanApplication extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $fillable=[
        'client_id',
        'amount_applied',
        'amount_approved',
        'total_interest',
        'status',
        'rate',
        'duration',
        'due_date',
        'purpose',
        'user_id',
        'repayment_frequency',
        'product_id',
        'approval_date',
        'disbursement_date',
        'officer_id'
    ];

    public function getAmountApprovedAttribute($value)
    {
        if($value==null){
            return 0;
        }
        return $value;
    }

    public function getTotalInterestAttribute($value)
    {
        if($value==null){
            return 0;
        }
        return $value;
    }
    public function product()
    {
        return $this->hasOne(Product::class,'id','product_id');
    }

    public function client()
    {
        return $this->hasOne(Clients::class,'id','client_id');
    }

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    public function officer()
    {
        return $this->hasOne(User::class,'id','officer_id');
    }

    public function repayments()
    {
        return $this->hasMany(Repayment::class,'loan_application_id','id');
    }

    public function collaterals()
    {
        return $this->hasMany(Collaterals::class,'application_id','id');
    }

    public function nextofkins()
    {
        return $this->hasMany(NextOfKin::class,'loan_applications_id','id');
    }

    public function guarantors()
    {
        return $this->hasMany(Guarantor::class,'application_id','id');
    }

    public function charges()
    {
        return $this->hasManyThrough(Charge::class,Product::class,'id','product_id','product_id','id');
    }
}
