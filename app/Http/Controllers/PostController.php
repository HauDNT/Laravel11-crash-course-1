<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // Display list posts
    public function index()
    {
        $posts = Post::orderByDesc("created_at")->paginate(6);

        return view("posts.index", ["posts" => $posts]);
    }

    // Show the form for creating a new post
    public function create(Request $request, Post $post)
    {

    }

    // Store a newly created resource in storage
    public function store(Request $request, Post $post)
    {
        // Validate:
        $fields = $request->validate([
            'title' => ["required", "max:255"],
            'body' => ["required"],
        ]);

        // Create a post
        Auth::user()->posts()->create($fields);

        return back()->with("success", "Your post was created!");
    }

    public function update(Request $request, Post $post)
    {
        dd("OK");
    }


}
