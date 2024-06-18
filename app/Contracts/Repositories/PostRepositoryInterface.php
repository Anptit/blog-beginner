<?php

namespace App\Contracts\Repositories;

use App\Contracts\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Builder as EBuilder;
use Illuminate\Database\Query\Builder;

interface PostRepositoryInterface extends RepositoryInterface
{
    public function getLastPost(Builder|EBuilder $query);

    public function getPost1Week(Builder|EBuilder $query);

    public function getPost1Month(Builder|EBuilder $query);

    public function getPost6Months(Builder|EBuilder $query);

    public function getPost1Year(Builder|EBuilder $query);

    public function getPostMore1Year(Builder|EBuilder $query);

    public function greeting();

}