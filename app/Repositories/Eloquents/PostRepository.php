<?php

namespace App\Repositories\Eloquents;

use App\Contracts\Repositories\PostRepositoryInterface;
use Illuminate\Database\Eloquent\Builder as EBuilder;
use Illuminate\Database\Query\Builder;
use App\Models\Post;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    public function model()
    {
        return Post::class;
    }

    public function getLastPost(Builder|EBuilder $query)
    {
        $lastPost = $query->orderBy('created_at', 'desc')->first();

        return $lastPost;
    }

    public function getPost1Week($post)
    {
        
    }

    public function getPost1Month($post)
    {

    }

    public function getPost6Month($post)
    {

    }

    public function getPost1Year($post)
    {
        
    }

    public function getPostMore1Year($post)
    {

    }
}