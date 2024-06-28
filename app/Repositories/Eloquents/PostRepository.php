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
        $post = $query->whereDate('updated_at', '>=', Carbon::now()->subWeek())->get();

        return $post;
    }

    public function getPost1Month($query)
    {
        $post = $query->whereDate('updated_at', '>=', Carbon::now()->subMonth())->get();

        return $post;
    }

    public function getPost6Months($query)
    {
        $post = $query->whereBetween('updated_at', '>=', Carbon::now()->subMonths(6))->get();

        return $post;
    }

    public function getPost1Year($query)
    {
        $post = $query->whereBetween('updated_at', '>=', Carbon::now()->subYear())->get();

        return $post;
    }

    public function getPostMore1Year($query)
    {
        $post = $query->whereDate('updated_at', '<', Carbon::now()->subYear())->get();

        return $post;
    }

    public function greeting()
    {
        return "hello";
    }

    public function comment()
    {
        return "abcd";
    }

    public function checkComment()
    {
        return true;
    }

    public function checkUser()
    {
        return true;
    }
}