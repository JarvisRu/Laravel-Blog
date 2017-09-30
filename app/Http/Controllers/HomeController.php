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
        // get all post
        $allPost = Post::all();
        return view('home',[
            'allPost' => $allPost
        ]);
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
        return redirect('home');
    }

    // Action: View post
    public function viewPost($id)
    {
        $this_post = Post::find($id);
        return view('view',[
            'this_post' => $this_post
        ]);
    }

    // Action: delete post
    public function destoryPost($id)
    {
        $this_post = Post::find($id);
        $this_post->delete();
        // go back to home
        return redirect('home');
    }

}
