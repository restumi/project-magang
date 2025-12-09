<?php

namespace App\Http\Controllers\Social;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Video;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function storePostComment(Request $request, Post $post)
    {
        $request->validate([
            'body' => 'required|string|max:1000'
        ]);

        $post->comments()->create([
            'user_id' => auth()->id(),
            'body' => $request->body,
        ]);

        return back()->with('success', 'comment sent!');
    }

    public function storeVideoComment(Request $request, Video $video)
    {
        $request->validate([
            'body' => 'required|string|max:1000'
        ]);

        $video->comments()->create([
            'user_id' => auth()->id(),
            'body' => $request->body
        ]);

        return back()->with('success', 'comment!');
    }

    public function deleteComment(Comment $comment)
    {
        if($comment->user_id != auth()->id()){
            abort(403);
        }

        $comment->delete();
        return back()->with('success', 'comment deleted');
    }
}
