<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function createPost(Request $request)
    {
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = Auth::id();

        Post::create($incomingFields);

        return redirect('/')->with('success', 'Post created successfully!');
    }

    public function showEditForm(Post $post)

    {
        if ($post->user_id !== Auth::id()) {
            return redirect('/')->with('error', 'You are not authorized to edit this post.');
        }
        return view('/edit-post', ['post' => $post]);
    }

    public function updatePost(Post $post, Request $request)
    {
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);

        $post->update($incomingFields);

        return redirect('/')->with('success', 'Post updated successfully!');
    }
}
