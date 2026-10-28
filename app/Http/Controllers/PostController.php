<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    
    public function index()
    {
        $search = request('search');

        $posts = Post::latest()
            ->where('title', 'like', '%' . $search . '%')
            ->paginate(request('per_page', 10))
            ->withQueryString();

        return view('posts.index', compact('posts', 'search'));
    }

    public function trash()
    {
        $posts = Post::onlyTrashed()->latest()->get();

        return view('posts.trash', compact('posts'));
    }

    public function restore($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        $post->restore();

        return redirect()->route('posts.trash');
    }

    public function forceDelete($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        $post->forceDelete();

        return redirect()->route('posts.trash');
    }
}