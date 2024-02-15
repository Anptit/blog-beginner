<?php

namespace App\Repositories\Eloquents;

use App\Contracts\Repositories\CommentRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as EBuilder;
use Illuminate\Database\Query\Builder;
use App\Models\Post;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface
{
    public function model()
    {
        return Post::class;
    }

    public function getLastComment(Builder|EBuilder $query)
    {
        $lastComment = $query->orderBy('updated_at', 'desc')->first();

        return $lastComment;
    }

    public function getComment1Week(Builder|EBuilder $query)
    {
        $comment = $query->whereDate('updated_at', '>=', Carbon::now()->subWeek())->get();

        return $comment;
    }

    public function getComment1Month($query)
    {
        $comment = $query->whereDate('updated_at', '>=', Carbon::now()->subMonth())->get();

        return $comment;
    }

    public function getComment6Months($query)
    {
        $comment = $query->whereBetween('updated_at', '>=', Carbon::now()->subMonths(6))->get();

        return $comment;
    }

    public function getComment1Year($query)
    {
        $comment = $query->whereBetween('updated_at', '>=', Carbon::now()->subYear())->get();

        return $comment;
    }

    public function getCommentMore1Year($query)
    {
        $comment = $query->whereDate('updated_at', '<', Carbon::now()->subYear())->get();

        return $comment;
    }
}