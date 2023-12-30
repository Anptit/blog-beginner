<?php

namespace App\Repository\Post;
use App\Repository\BaseRepository;

abstract class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Post::class;
    }
}