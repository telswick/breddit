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
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subbreddit = new \App\Subbreddit;

        $subbreddit->user_id = Auth::user()->id;         // changing $request to Auth::
        $subbreddit->name = $request->name;
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
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $subbreddit = \App\Subbreddit::find($id)

        $subbreddit->user_id = Auth::user()->id;              // changing $request to Auth::
        $subbreddit->name = $request->name;
        $subbreddit->description = $request->description;
        
        $subbreddit->save();

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
        $subbreddit->delete();
        // or replace find/delete with destroy in one line

        return $subbreddit;    // good in case of needing to undo


    }
}
