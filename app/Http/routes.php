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

Route::group(['middleware' => ['web']], function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::resource('subbreddits', 'SubbredditsController', [
    	'only' => ['index', 'show']
    ]);    

    // Adding routes for posts
    Route::resource('posts', 'PostsController', [
        'only' => ['index', 'show']
    ]);   

    // Adding routes for comments
    Route::resource('comments', 'CommentsController', [
        'only' => ['index', 'show']
    ]);   



});

// Question: what is the difference between ['web'] and 'web' groups?

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');

    Route::resource('subbreddits', 'SubbredditsController', [
    	'except' => ['create', 'edit']
    ]);

    // Adding routes for posts
    Route::resource('posts', 'PostsController', [
        'except' => ['create', 'edit']
    ]);

    // Adding routes for comments
    Route::resource('comments', 'CommentsController', [
        'except' => ['create', 'edit']
    ]);

});
