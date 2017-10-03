<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
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

    // ===================================================
    // post 
    // ===================================================

    // Action: update post
    public function updatePost(Request $request)
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
        $allComment = Comment::where('p_id','=',$id)->get();
        return view('view',[
                'this_post' => $this_post,
                'allComment' => $allComment
            ]);
    }

    // Action: delete post
    public function destoryPost($id)
    {
        // del this post
        $this_post = Post::find($id);
        $this_post->delete();
        // del all comment of this post
        Comment::where('p_id','=',$id)->delete();
        // go back to home
        return redirect('home');
    }

    // ===================================================
    // comment
    // ===================================================
    // Action: update Comment
    public function updateComment(Request $request,$id)
    {
        $Comment = new Comment();
        $Comment->name = Auth::user()->name;
        $Comment->content = $request->content;
        $Comment->p_id = $id;
        $Comment->save();

        // go back to this post
        $this_post = Post::find($id);
        $allComment = Comment::where('p_id','=',$id)->get();
        return view('view',[
                'this_post' => $this_post,
                'allComment' => $allComment
            ]);
    }

    // Action: delete Comment
    public function destoryComment($id,$p_id)
    {
        $this_Comment = Comment::find($id);
        $this_Comment->delete();
        // go back to this post
        $this_post = Post::find($p_id);
        $allComment = Comment::where('p_id','=',$p_id)->get();
        return view('view',[
                'this_post' => $this_post,
                'allComment' => $allComment
            ]);
    }

}
