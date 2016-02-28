<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SubbredditsController extends Controller
{
    /**
     * Display a listing of the resource.
     * Get request to subbreddits route
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return \App\Subbreddit::all();
    }

    // Removed create


    /**
     * Store a newly created resource in storage.
     * Subbreddits have user_id, title, description
     * Fix: my subbreddits have title and not name!!
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subbreddit = new \App\Subbreddit;

        $subbreddit->user_id = \Auth::user()->id;         // changing $request to \Auth::
        $subbreddit->title = $request->title;              // change name to title
        $subbreddit->description = $request->description;
        
        $subbreddit->save();

        return $subbreddit;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return \App\Subbreddit::with([
            'posts.comments.childComments', 
            'user'
        ])->find($id);
    }

    // removed edit
  

    /**
     * Update the specified resource in storage.
     * Subbreddits have user_id, title, description
     * Fix: my subbreddits have title and not name!!
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $subbreddit = \App\Subbreddit::find($id);

        // Add authorization, must be owner to update

        if ($subbreddit->user_id == \Auth::user()->id)  {
            // $subbreddit->user_id = Auth::user()->id;         // Remove, can't update user_id
            $subbreddit->title = $request->title;               // change name to title
            $subbreddit->description = $request->description;
        
            $subbreddit->save();
        }
        else  {
            return response("Unauthorized", 403);
        }  
        

        return $subbreddit;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $subbreddit = \App\Subbreddit::find($id);

        // Add authorization, must be owner to destroy

        if ($subbreddit->user_id == \Auth::user()->id)  {
            $subbreddit->delete();
        // or replace find/delete with destroy in one line
        }
        else  {
            return response("Unauthorized", 403);
        }

        return $subbreddit;    // good in case of needing to undo


    }
}
