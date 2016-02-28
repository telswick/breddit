<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Decided to move get and resource routes to web middleware group below

Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/


// Question: what is the difference between ['web'] and 'web' groups? No diff

Route::group(['middleware' => 'web'], function () {
    Route::auth();


    Route::get('/home', 'HomeController@index');


    Route::resource('subbreddits', 'SubbredditsController', [
        'only' => ['index', 'show']          // be more explicit by using only
    ]);


    Route::resource('posts', 'PostsController', [
        'only' => ['index', 'show']
    ]);


    Route::resource('comments', 'CommentsController', [
        'only' => ['index', 'show']
    ]);


    Route::group(['middleware' => 'auth'], function () {
        Route::resource('posts', 'PostsController', [
            'only' => ['store', 'update', 'destroy']
        ]);
        Route::resource('comments', 'CommentsController', [
            'only' => ['store', 'update', 'destroy']
        ]);
        Route::resource('subbreddits', 'SubbredditsController', [
            'only' => ['store', 'update', 'destroy']
        ]);

    });

});
