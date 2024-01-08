<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePost;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $postService;

    public function __construct(PostService $postService)
    {   
        $this->postService = $postService;
    }

    public function index()
    {
        return view('posts.index', [
            'title' => 'Create post',
            'user' => auth()->user()
        ]);
    }

    public function create(CreatePost $request)
    {
        $validator = $request->validated();

        $validator['user_id'] = auth()->user()->id;

        $post = $this->postService->createPost($validator);

        return view('posts.preview-post', [
            'post' => $post,
            'title' => $validator['title'],
            'user' => auth()->user()
        ]);
    }
}
