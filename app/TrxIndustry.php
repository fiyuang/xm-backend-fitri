<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrxIndustry extends Model
{
    protected $guarded = [];

    protected $appends = ['industry_name'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function industry()
    {
        return $this->belongsTo('App\Industry', 'industry_id');
    }

    public function getIndustryNameAttribute()
    {
        $industry = $this->industry()->first();

        return $industry->name ?? null;
    }
}
