<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrxTag extends Model
{
    protected $guarded = [];

    protected $appends = ['tag_name'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function tag()
    {
        return $this->belongsTo('App\Tag', 'tag_id');
    }

    public function getTagNameAttribute()
    {
        $tag = $this->tag()->first();

        return $tag->name ?? null;
    }
}
