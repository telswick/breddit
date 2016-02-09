<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * Get the comments of the post.
     * The post can have many comments.
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    /**
     * Get the user it (the post) belongs to.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the subbreddit it (the post) belongs to.
     */
    public function subreddit()
    {
        return $this->belongsTo('App\Subreddit');
    }


}
