<?php

namespace App\Repositories\Eloquents;

use App\Contracts\Repositories\PostRepositoryInterface;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    public function model()
    {
        return \App\Models\Post::class;
    }

    public function getPost1Week()
    {
        
    }

    public function getPost1Month()
    {

    }

    public function getPost6Month()
    {

    }

    public function getPost1Year()
    {
        
    }
}