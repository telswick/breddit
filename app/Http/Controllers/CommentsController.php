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

        $comment->user_id = Auth::user()->id;         // changing $request to Auth::
        $comment->content = $request->content;
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

        $comment->user_id = Auth::user()->id;              // changing $request to Auth::
        $comment->content = $request->content;
        $comment->post_id = $request->post_id;
        $comment->comment_id = $request->comment_id;
        
        $comment->save();

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
        $comment->delete();
        // or replace find/delete with destroy in one line

        return $comment;    // good in case of needing to undo
    }
}
