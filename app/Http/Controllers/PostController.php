<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;

class PostController extends Controller
{
	// check Auth
	public function __construct()
    {
        // make sure has login
        $this->middleware('auth');
    }

	// show all post
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

    // update post
    public function updatePost(Request $request)
    {
        // validate
        $request->validate([
            'title' => 'required|string|max:15',
            'content' => 'required|string|max:255',
        ]);

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

    // view post
    public function viewPost($id)
    {
        $this_post = Post::find($id);
        $allComment = Comment::where('p_id','=',$id)->get();
        return view('view',[
                'this_post' => $this_post,
                'allComment' => $allComment
            ]);
    }

    // delete post
    public function destoryPost($id)
    {
        // del this post
        $this_post = Post::find($id);
        // check auth
        if(Auth::user()->name === $this_post->name){
            $this_post->delete();
            // del all comment of this post
            Comment::where('p_id','=',$id)->delete();
            // go back to home
            return redirect('home');
        }
        
    }
}
