<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Activity;

class Schedule extends Model
{
    protected $guarded = [];

    protected $appends = [
        'scheduledate'
    ];

    protected $dates = [
        'date'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function guru()
    {
        return $this->belongsTo('App\User', 'guru_id');
    }

    public function talent()
    {
        return $this->belongsTo('App\User', 'talent_id');
    }

    public function activities()
    {
        return $this->morphMany(Activity::class, 'subject')->orderBy('id', 'desc');
    }

    public function getScheduledateAttribute()
    {
        return $this->date ? $this->date->format('d F Y') : '-';
    }
}
