<?php

namespace App\Repositories\Interfaces;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface TopicRepository.
 *
 * @package namespace App\Repositories;
 */
interface QuestionRepository extends RepositoryInterface
{
    public function count();

    public function getListQuestion();

    public function randomOrder(array $where);

    public function search($term);
}
