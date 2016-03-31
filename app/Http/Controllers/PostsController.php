<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return \App\Post::with('subbreddit')->orderBy('id', 'desc')->get();
    }

    // Removed create



    /**
     * Store a newly created resource in storage.
     * Posts have user_id, title, content
     * and also subbreddit_id and url
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new \App\Post;

        $post->user_id = \Auth::user()->id;         // changing $request to \Auth::
        $post->title = $request->title;
        $post->post_content = $request->post_content;    // change to post_content
        $post->url = $request->url;
        $post->subbreddit_id = $request->subbreddit_id;
        
        $post->save();

        return $post;
        
    }

    /**
     * Display the specified resource.
     * Note: may need to fix order below
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return \App\Post::with([
            'comments.childComments', 
            'user', 'subbreddits'
        ])->find($id);
    }

    // removed edit

    /**
     * Update the specified resource in storage.
     * Posts have user_id, title, content
     * and also subbreddit_id and url
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = \App\Post::find($id);

        // Add authorization, must be owner to update

        if ($post->user_id == \Auth::user()->id)  {
            // $post->user_id = Auth::user()->id;              // Remove, can't update user_id
            $post->title = $request->title;
            $post->post_content = $request->post_content;           // Change to post_content
            $post->url = $request->url;
            // $post->subbreddit_id = $request->subbreddit_id; // Remove, can't update subbreddit_id   
        
            $post->save();
        }
        else  {
            return response("Unauthorized", 403);
        }

        return $post;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        // Add authorization, must be owner to destroy

        if ($post->user_id == \Auth::user()->id)  {
            $post = \App\Post::find($id);
            $post->delete();
            // or replace find/delete with destroy in one line
        }
        else  {
            return response("Unauthorized", 403);
        }

        return $post;    // good in case of needing to undo


    }
}
