<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Request\StorePostRequest;
use Illuminate\Http\Request\UpdatePostRequest;

class PostController extends Controller
{
    // Display list posts
    public function index()
    {
        $posts = Post::orderByDesc("created_at")->paginate(6);

        return view("posts.index", ["posts" => $posts]);
    }

    // Show the form for creating a new post
    public function create()
    {

    }

    // Store a newly created resource in storage
    public function store(StorePostRequest $request, Post $post)
    {

    }




}
