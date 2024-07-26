<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->except(['index', 'show']);
    }

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
        $request->validate([
            'title' => ["required", "max:255"],
            'body' => ["required"],
            'image' => ['nullable', 'file', 'max:3000', 'mimes:png,jpg,webp'],
        ]);

        // Storage image if exists:
        // Storage in [store/app/public/posts_images]
        $path = null;
        if ($request->hasFile('image')) {
            $path = Storage::disk("public")->put("posts_images", $request->image);
        }

        // Create a post
        Auth::user()->posts()->create([
            'title' => $request->title,
            'body' => $request->body,
            'image' => $path,
        ]);

        return back()->with("success", "Your post was created!");
    }

    public function show(Post $post)
    {
        return view("posts.show", ["post" => $post]);
    }

    public function edit(Post $post)
    {
        // Authorize the action:
        Gate::authorize("modify", $post);

        return view("posts.edit", ["post" => $post]);
    }

    public function update(Request $request, Post $post)
    {
        // Authorize the action:
        Gate::authorize("modify", $post);

        // Validate:
        $fields = $request->validate([
            'title' => ["required", "max:255"],
            'body' => ["required"],
            'image' => ['nullable', 'file', 'max:3000', 'mimes:png,jpg,webp'],
        ]);

        // Storage image if exists:
        // Storage in [store/app/public/posts_images]
        $path = $post->image ?? null;
        if ($request->hasFile('image')) {
            if ($post->image) 
            {
                // Delete old image
                Storage::disk("public")->delete($post->image);
            }
            // Add new image
            $path = Storage::disk("public")->put("posts_images", $request->image);
        }

        // Update a post
        $post->update([
            'title' => $request->title,
            'body' => $request->body,
            'image' => $path,
        ]);

        return back()->with("success", "Your post was updated!");
    }

    public function destroy(Post $post)
    {
        // Authorize the action:
        Gate::authorize("modify", $post);

        // Delete post image if exists:
        if ($post->image) 
        {
            Storage::disk("public")->delete($post->image);
        }

        // Delete the post:
        $post->delete();

        // Redirect to dashboard:
        return back()->with('delete', 'Your post was deleted!');
    }
}
