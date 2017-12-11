<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use Auth;

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
        $allPost = Post::with('user')->get();
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

        $request->user()->posts()->create([
                'user_id' => $request->user()->id,
                'title' => $request->title,
                'content' => $request->content
            ]);

        // go back to home
        return redirect('home');
    }

    // view post
    public function viewPost(Post $post)
    {
        $allComment = $post->comments()->with('user')->get();
        return view('view',[
                'this_post' => $post,
                'allComment' => $allComment
            ]);
    }

    // delete post
    public function destoryPost(Request $request,Post $post)
    {
        // check auth
        if($request->user()->id === $post->id){
            $post->delete();
            // del all comment of this post
            $post->comments()->delete();
            // go back to home
            return redirect('home');
        }
        
    }
}
