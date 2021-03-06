<?php

namespace App\Http\Controllers;

//
//use Illuminate\Http\Request;



use App\Posts;
use App\User;
use Psy\Exception\ErrorException;
use Redirect;
use App\Http\Controllers\Controller;
//use App\Http\Requests\PostFormRequest;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller {

    public function index() {
        $posts = Posts::where('active', '1')->orderBy('created_at', 'desc')->paginate(5);
        $title = 'Latest Posts';
        
//        return "dsdfds";
        return view('home')->withPosts($posts)->withTitle($title);
    }

    public function show($slug) {
        $post = Posts::where('slug', $slug)->first();

        if ($post) {
            if ($post->active == false)
                return redirect('/')->withErrors('requested page not found');
            $comments = $post->comments;
        }
        else {
            return redirect('/')->withErrors('requested page not found');
        }
        return view('posts.show')->withPost($post)->withComments($comments);
    }

    public function create(Request $request) {
        // 
        if ($request->user()->can_post()) {
            return view('posts.create');
        } else {
            return redirect('/')->withErrors('You have not sufficient permissions for writing post');
        }
    }

    public function store(Request $request) {
        $post = new Posts();

        $images=$this->multiple_upload($request->file('images'));
        $post->title = $request->get('title');
        $post->body = $request->get('body');
        $post->map = $request->get('map');
        $post->image =json_encode($images);
        $post->slug = str_slug($post->title);
        $post->author_id = $request->user()->id;
        if ($request->has('save')) {
            $post->active = 0;
            $message = 'Post saved successfully';
        } else {
            $post->active = 1;
            $message = 'Post published successfully';
        }
        $post->save();

        return redirect('/');
    }

    public function edit(Request $request, $slug) {
        $post = Posts::where('slug', $slug)->first();
        if ($post && ($request->user()->id == $post->author_id || $request->user()->is_admin()))
            return view('posts.edit')->with('post', $post);

        else {
            return redirect('/')->withErrors('you have not sufficient permissions');
        }
    }

    public function update(Request $request) {
        //
        $post_id = $request->input('post_id');
        $post = Posts::find($post_id);
        if ($post && ($post->author_id == $request->user()->id || $request->user()->is_admin())) {
            $title = $request->input('title');
            $slug = str_slug($title);
            $duplicate = Posts::where('slug', $slug)->first();
            if ($duplicate) {
                if ($duplicate->id != $post_id) {
                    return redirect('edit/' . $post->slug)->withErrors('Title already exists.')->withInput();
                } else {
                    $post->slug = $slug;
                }
            }

            $post->title = $title;
            $post->body = $request->input('body');

            if ($request->has('save')) {
                $post->active = 0;
                $message = 'Post saved successfully';
                $landing = 'edit/' . $post->slug;
            } else {
                $post->active = 1;
                $message = 'Post updated successfully';
                $landing = $post->slug;
            }
            $post->save();
            return redirect($landing)->withMessage($message);
        } else {
            return redirect('/')->withErrors('you have not sufficient permissions');
        }
    }

    public function destroy(Request $request, $id) {
        //
      
        
        $post = Posts::find($id);
        if ($post && ($post->author_id == $request->user()->id || $request->user()->is_admin())) {
            $post->delete();
            $data['message'] = 'Post deleted Successfully';
        } else {
            $data['errors'] = 'Invalid Operation. You have not sufficient permissions';
        }

        return redirect('/')->with($data);
    }


    public function multiple_upload($files)
    {
        // getting all of the post data
//        $files = Input::file('images');
        // Making counting of uploaded images
        $file_count = count($files);
        $imageArray=array();
        // start count how many uploaded
        $uploadcount = 0;
        foreach ($files as $file) {
            $rules = array('file' => 'required'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
            $validator = Validator::make(array('file' => $file), $rules);
            if ($validator->passes()) {
                $destinationPath = base_path() . '/public/img';
                $filename = $file->getClientOriginalName();
                $upload_success = $file->move($destinationPath, $filename);
                $uploadcount++;
                $imageArray[]=$filename;
            }
        }
        if ($uploadcount == $file_count) {
            return $imageArray;
        }
        else
            return false;
    }


    public function get()
    {
        $artical = Posts::all();
        return response()->json(['data' => $artical], 200);
    }

    public  function  insert(Request $request)
    {

        $values=$request->all();
        $values['author_id']=1;
        Posts::create($values);
        return response()->json(['message'=>' artical Add ','code'=>201]);
    }

}
