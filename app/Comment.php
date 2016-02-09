<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    

	/**
     * Get the comments of the comment.
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }



	/**
     * Get the post it (the comment) belongs to.
     */
    public function post()
    {
        return $this->belongsTo('App\Post');  
    }

    /**
     * Get the user it (the comment) belongs to.
     */
    public function user()
    {
        return $this->belongsTo('App\User');  
    }




}
