<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use Auth;

class CommentController extends Controller
{
	// check Auth
	public function __construct()
    {
        // make sure has login
        $this->middleware('auth');
    }

    // update Comment
    public function updateComment(Request $request,$id)
    {
        // validate
        $request->validate([
            'content' => 'required|string|max:30',
        ]);
        // save it
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

    // delete Comment
    public function destoryComment($id,$p_id)
    {
        $this_Comment = Comment::find($id);
        // check auth
        if(Auth::user()->name === $this_Comment->name){
            $this_Comment->delete();
        }
        // go back to this post
        $this_post = Post::find($p_id);
        $allComment = Comment::where('p_id','=',$p_id)->get();
        return view('view',[
                'this_post' => $this_post,
                'allComment' => $allComment
            ]);
        
    }
}
