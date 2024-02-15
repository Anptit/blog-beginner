<?php

namespace App\Contracts\Repositories;

use App\Contracts\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Builder as EBuilder;
use Illuminate\Database\Query\Builder;

interface CommentRepositoryInterface extends RepositoryInterface
{
    public function getLastComment(Builder|EBuilder $query);

    public function getComment1Week(Builder|EBuilder $query);

    public function getComment1Month(Builder|EBuilder $query);

    public function getComment6Months(Builder|EBuilder $query);

    public function getComment1Year(Builder|EBuilder $query);

    public function getCommentMore1Year(Builder|EBuilder $query);
}