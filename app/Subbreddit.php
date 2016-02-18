<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subbreddit extends Model
{
    /**
     * Get the posts of the subbreddit.
     */
    public function posts()
    {
        return $this->hasMany('App\Post');
    }
    /**
     * Get the user it belongs to.
     * Get the user that owns the subbreddit.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    /**
     * Get the users that are subscribed to this subbreddit
     * Get the subscribed users of the subbreddit.
     */
    public function subscribedUsers()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }
}
