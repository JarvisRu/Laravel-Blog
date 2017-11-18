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
    public function updateComment(Request $request,Post $post)
    {
        // validate
        $request->validate([
            'content' => 'required|string|max:30',
        ]);

        // save it
        $post->comments()->create([
                'user_id' => $request->user()->id,
                'content' => $request->content
            ]);

        // go back to this post
        return redirect()->action('PostController@viewPost',['post'=>$post]);
    }

    // delete Comment
    public function destoryComment(Post $post, Comment $comment)
    {
        // check auth
        if(Auth::user()->id === $comment->user_id){
            $comment->delete();
        }
        // go back to this post
        return redirect()->action('PostController@viewPost',['post'=>$post]);
    }
}
