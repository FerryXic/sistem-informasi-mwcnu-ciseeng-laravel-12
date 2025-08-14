<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //index
    public function index(Request $request)
    {
        $keyword = $request->q;

        $posts = Post::with('user')
            ->where('category', '!=', 'proker') 
            ->when($keyword, function ($query) use ($keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('title', 'like', "%{$keyword}%")
                    ->orWhere('category', 'like', "%{$keyword}%")
                    ->orWhereHas('user', function ($q2) use ($keyword) {
                        $q2->where('name', 'like', "%{$keyword}%");
                    });
                });
            })
            ->latest()
            ->paginate(6); 

        return view('User.Post.Index', compact('posts'));
    }

    // postingan tunggal
    public function show($title)
    {
        $post = Post::where('title', $title)->with('user')->firstOrFail();

        $relatedPosts = Post::where('category', $post->category)
                            ->where('id', '!=', $post->id)
                            ->latest()
                            ->take(5)
                            ->get();

        return view('User.Post.Read', compact('post', 'relatedPosts'));
    } 
}