<?php

namespace App\Contracts\Repositories;

use App\Contracts\Repositories\RepositoryInterface;

interface PostRepositoryInterface extends RepositoryInterface
{
    public function getLastPost();
}