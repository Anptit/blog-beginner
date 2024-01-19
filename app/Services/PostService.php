<?php

namespace App\Services;

use App\Contracts\Repositories\PostRepositoryInterface;
use App\Models\Post;
use Carbon\Carbon;

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
        $user = $post->user_id;

        if (!isset($user)) {
            return abort(400);
        }
        
        $validator = $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $tmpArr = array(
            'user_id' => $user,
            'updated_at' => Carbon::now()
        );

        $postUpdate = $this->postRepository->update($post->id, array_merge($validator, $tmpArr));

        return response()->json([
            'message' => 'Get post success!',
            'data' => $postUpdate
        ], 200);
    }

    public function deletePost($post)
    {
        $check = $this->postRepository->delete($post->id);

        if ($check) {
            return response()->json(null, 204);
        }
    }
}