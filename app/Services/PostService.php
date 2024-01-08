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

    public function createPost($post)
    {
        return $this->postRepository->create($post);
    }
}