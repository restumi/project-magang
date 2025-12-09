<?php

namespace App\Http\Controllers\Social;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('comments')->latest()->get();
        return view('posts.index', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string'
        ]);

        Post::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'content' => $request->content
        ]);

        return redirect()->back()->with('success', 'new blog uploaded');
    }

    public function update(Request $request, Post $post)
    {
        if($post->user_id != auth()->id()){
            abort(403);
        }

        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string'
        ]);

        $post->update($request->only('title', 'content'));

        return redirect()->back()->with('success', 'blog updated!');
    }

    public function destroy(Post $post)
    {
        if($post->user_id != auth()->id()){
            abort(403);
        }

        $post->comments()->delete();
        $post->delete();
        return redirect()->back()->with('success', 'blog deleted!');
    }
}
