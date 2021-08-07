<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $appends = [
        'birthdate'
    ];

    protected $dates = [
        'date_of_birth'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function getBirthdateAttribute()
    {
        return $this->date_of_birth ? $this->date_of_birth->format('d F Y') : '-';
    }
}
