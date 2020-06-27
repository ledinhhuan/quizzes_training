<?php

namespace App\Repositories\Interfaces;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface TestResultRepository.
 *
 * @package namespace App\Repositories\Interfaces;
 */
interface TestResultRepository extends RepositoryInterface
{
    public function groupByResults();
}
