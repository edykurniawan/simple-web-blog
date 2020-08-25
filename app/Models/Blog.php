<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Blog extends Model
{
    protected $fillable = ['title_blog', 'thumbnail_blog', 'slug', 'content_blog', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function getCreatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['created_at'])
            ->format('l, d M Y');
    }

    public function isOwner()
    {
        return Auth::user()->id == $this->user->id;
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }
}
