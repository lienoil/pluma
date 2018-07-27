<?php

namespace Pluma\Support\Repository;

use Pluma\Support\Repository\Repository;

trait RegistersRepository
{
    /**
     * Bind the repository.
     * @param \Pluma\Support\Repository\Repository $repository
     * @return void
     */
    public function bind($repository)
    {
        $this->repository = new $repository;
    }
}
