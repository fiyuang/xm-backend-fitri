<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $guarded = [];

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
}
