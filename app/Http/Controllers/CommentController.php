<?php

namespace App\Http\Controllers;

use App\Posts;
use App\Comments;
use App\User;
use Redirect;
use App\Http\Controllers\Controller;
//use App\Http\Requests\PostFormRequest;
use App\Http\Requests;
use Illuminate\Http\Request;
//
//use Illuminate\Http\Request;
//use App\Http\Requests;

class CommentController extends Controller {

    public function store(Request $request) {
        //on_post, from_user, body
        $input['from_user'] = $request->user()->id;
        $input['on_post'] = $request->input('on_post');
        $input['body'] = $request->input('body');
        $slug = $request->input('slug');
        Comments::create($input);

        return redirect($slug)->with('message', 'Comment published');
    }

}
