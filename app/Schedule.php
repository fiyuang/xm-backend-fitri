<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Activity;

class Schedule extends Model
{
    protected $guarded = [];

    protected $appends = [
        'date_formatted',
        'status_formatted'
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

    public function getDateFormattedAttribute()
    {
        return $this->date ? $this->date->format('d F Y') : '-';
    }

    public function getStatusFormattedAttribute()
    {
        $status = '';
        switch ($this->is_approved) {
            case 1:
                $status = 'Waiting';
                break;

            case 2:
                $status = 'Approved';
                break;

            case 3:
                $status = 'Not Approved';
                break;

            case 4:
                $status = 'Saved';
                break;

            case 5:
                $status = 'Decline';
                break;
                
            default:
                return $this->is_approved;
                break;
        }
        return $status;
    }
}
