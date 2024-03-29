<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePost;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PostController extends Controller
{
    private $postService;

    public function __construct(PostService $postService)
    {   
        $this->postService = $postService;
    }

    public function index(Request $request)
    {
        return $this->postService->index($request);
    }

    public function create(CreatePost $request)
    {
        return $this->postService->createPost($request);
    }

    public function show(Post $post)
    {
        try {
            return response()->json(['data' => $post, 'message' => 'Success!'], 200);
        } catch (NotFoundHttpException $e) {
            abort(400);
        }
    }

    public function edit(Request $request,Post $post)
    {
        return $this->postService->editPost($request, $post);
    }

    public function destroy(Post $post)
    {
        return $this->postService->deletePost($post);
    }
    
}
