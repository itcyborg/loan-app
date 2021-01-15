<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Revenue extends Model
{

    protected $fillable=[
        'log_id',
        'category',
        'type',
        'amount',
        'comment',
        'user_id',
    ];

    protected $casts=[
        'created_at' => 'datetime:F j, Y',
        'updated_at' => 'datetime:F j, Y',
    ];

    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->log_id = (string) Str::uuid();
            $model->user_id=Auth::id();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
