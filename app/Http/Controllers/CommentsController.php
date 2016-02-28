<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return \App\Comment::all();
    }

    // Removed create

    /**
     * Store a newly created resource in storage.
     * Comments have user_id, content, 
     * and also post_id, comment_id
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comment = new \App\Comment;

        $comment->user_id = \Auth::user()->id;         // changing $request to \Auth::
        $comment->content = $request->comment_content;  // change to comment_content
        $comment->post_id = $request->post_id;
        $comment->comment_id = $request->comment_id;

        $comment->save();

        return $comment;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return \App\Comment::with([
            'childComments', 
            'user', 'subbreddits', 'posts'
        ])->find($id);
    }

    // removed edit

    /**
     * Update the specified resource in storage.
     * Comments have user_id, content, 
     * and also post_id, comment_id
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $comment = \App\Comment::find($id);

        // Add authorization, must be owner to update

        if ($comment->user_id == \Auth::user()->id)  {
            // $comment->user_id = Auth::user()->id;            // Remove, can't update user_id
            $comment->content = $request->comment_content;      // change to comement_content
            // $comment->post_id = $request->post_id;           // Remove, can't update post_id
            // $comment->comment_id = $request->comment_id;     // Remove, can't change comment_id
            $comment->save();
        }   
        else  {
            return response("Unauthorized", 403);
        }

        return $comment;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = \App\Comment::find($id);

        // Add authorization, must be owner to destroy

        if ($comment->user_id == \Auth::user()->id)  {
            $comment->delete();
            // or replace find/delete with destroy in one line
        }
        else  {
            return response("Unauthorized", 403);
        }    

        return $comment;    // good in case of needing to undo
    }
}
