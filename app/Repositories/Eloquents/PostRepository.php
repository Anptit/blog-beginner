<?php

namespace App\Repositories\Eloquents;

use App\Contracts\Repositories\PostRepositoryInterface;
use Carbon\Carbon;
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
        $lastPost = $query->orderBy('updated_at', 'desc')->first();

        return $lastPost;
    }

    public function getPost1Week(Builder|EBuilder $query)
    {
        $post = $query->whereBetween('updated_at', [Carbon::now()->subWeek(), Carbon::now()])
                      ->get();

        return $post;
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