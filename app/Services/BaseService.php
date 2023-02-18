<?php

namespace App\Services;

use App\Repositories\BaseRepository;

class BaseService
{
    public BaseRepository $repository;

    public function __construct(BaseRepository $repository)
    {
        $this->repository = $repository;
    }
}
