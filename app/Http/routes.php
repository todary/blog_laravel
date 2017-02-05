<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

//Route::get('/', function () {
//
//    return view('welcome');
//});


Route::get('getArtical', 'PostController@get');
Route::post('addArtical', 'PostController@insert');

Route::get('/', 'PostController@index');

Route::get('/home', 'PostController@index');


Route::pattern('id', '[0-9]+');

//Route::Resource('/home', 'HomeController');


Route::auth();

Route::group(['middleware' => ['auth']], function() {
    // form to create 
    Route::get('new-post', 'PostController@create');
    // to insert and create 
    Route::post('new-post', 'PostController@store');

//    Route::Resource('new-post', 'PostController');
    // to to get post to update it 
    Route::get('edit/{slug}', 'PostController@edit');

    // update post
    Route::post('update', 'PostController@update');

    Route::get('/my-drafts', 'UserController@draft');


    Route::get('/{slug}', 'PostController@show')->where('slug', '[A-Za-z0-9-_]+');

    // to delete post 
    Route::get('delete/{id}', 'PostController@destroy');

    // to add comment 
    Route::post('comment/add', 'CommentController@store');

    // display user's drafts


    Route::get('user/{id}', 'UserController@profile');

// display list of posts
    Route::get('user/{id}/posts', 'UserController@user_posts');
});

//Route::get('/home', 'HomeController@index');

////// route Api 

