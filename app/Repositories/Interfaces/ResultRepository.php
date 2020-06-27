<?php

namespace App\Repositories\Interfaces;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface ResultRepository.
 *
 * @package namespace App\Repositories\Interfaces;
 */
interface ResultRepository extends RepositoryInterface
{
    public function insertMany(array $attribute);
}
