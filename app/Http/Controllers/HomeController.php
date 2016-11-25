<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
//        return view('home');
        return view('index');
      
        
    }

    public function create() {
        return "welcom to update";
    }
    
     public function show() {
        return "welcom to asd";
    }

    public function delete() {
        return view('home')->with("key", "value");
    }

}
