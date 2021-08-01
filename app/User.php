<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\DocumentTrait;

class User extends Authenticatable
{
    use Notifiable, DocumentTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile()
    {
        return $this->hasOne('App\Profile');
    }

    public function trx_industry()
    {
        return $this->hasMany('App\TrxIndustry');
    }

    public function scopeHrOnly($query)
    {
        $query->where('user_type', 2);
    }

    public function scopeJobseekerOnly($query)
    {
        $query->where('user_type', 3);
    }
}
