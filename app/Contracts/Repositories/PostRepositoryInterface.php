<?php

namespace App\Contracts\Repositories;

use App\Contracts\Repositories\RepositoryInterface;

interface PostRepositoryInterface extends RepositoryInterface
{
    public function getLastPost();

    public function getPost1Week();

    public function getPost1Month();

    public function getPost6Month();

    public function getPost1Year();
}