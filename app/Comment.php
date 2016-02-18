<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    

	/**
     * Get the comments of the comment.
     * Get the child comments owned by the comment.
     */
    public function childComments()
    {
        return $this->hasMany('App\Comment');
    }



	/**
     * Get the post it (the comment) belongs to.
     * Get the post that owns the comment.
     */
    public function post()
    {
        return $this->belongsTo('App\Post');  
    }

    /**
     * Get the user it (the comment) belongs to.
     * Get the user that owns the comment.
     */
    public function user()
    {
        return $this->belongsTo('App\User');  
    }

    /**
     * Get the parent comment that owns the comment.
     */
    public function parentComment()
    {
        return $this->belongsTo('App\Comment');  
    }




}
