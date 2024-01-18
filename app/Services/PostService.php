<?php

namespace App\Services;

use App\Contracts\Repositories\PostRepositoryInterface;

class PostService
{
    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function createPost($request)
    {
        $validator = $request->validated();

        $validator['user_id'] = auth()->user()->id;

        $post =  $this->postRepository->create($validator);

        return response()->json(['data' => $post], 201);
    }

    public function editPost($request, $post)
    {
        $user = $this->postRepository->find($post->id)->user_id;
        if (!isset($user)) {
            return abort(400);
        }
        $validator = $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $validator['user_id'] = $user;

        $post = $this->postRepository->update($post->id, $validator);

        return response()->json([
            'message' => 'Get post success!',
            'data' => $post
        ], 200);
    }

    public function deletePost()
    {

    }
}