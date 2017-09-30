<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // make sure has login
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    // to addPost page 
    public function goPost()
    {
        return view('addPost');
    }

    // Action: update post
    public function update(Request $request)
    {
        // mothod 1
        $post = new Post();
        $post->name = Auth::user()->name;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();
        // method 2
        // $post = Post::create($request->all());

        // go back to home
        return view('home');
    }
}
