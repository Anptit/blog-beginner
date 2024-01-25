<?php

namespace App\Repositories\Eloquents;

use App\Contracts\Repositories\PostRepositoryInterface;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    public function model()
    {
        return \App\Models\Post::class;
    }

    public function getLastPost()
    {
        
    }
}