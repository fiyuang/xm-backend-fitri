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

    protected $appends = [
        'status_formatted',
    ];

    public function profile()
    {
        return $this->hasOne('App\Profile');
    }

    public function schedule()
    {
        return $this->hasMany('App\Schedule');
    }

    public function trx_tag()
    {
        return $this->hasMany('App\TrxTag');
    }

    public function scopeGuruOnly($query)
    {
        $query->where('user_type', 2);
    }

    public function scopeUserOnly($query)
    {
        $query->where('user_type', 3);
    }

    public function getStatusFormattedAttribute()
    {
        $status = '';
        switch ($this->status) {
            case 1:
                $status = 'Baru';
                break;

            case 2:
                $status = 'Menunggu Direview';
                break;

            case 3:
                $status = 'Approved';
                break;

            case 4:
                $status = 'Ditolak';
                break;
                
            default:
                return $this->status;
                break;
        }
        return $status;
    }
}
