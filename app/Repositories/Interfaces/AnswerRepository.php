<?php

namespace App\Repositories\Interfaces;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface TopicRepository.
 *
 * @package namespace App\Repositories;
 */
interface AnswerRepository extends RepositoryInterface
{
    public function insertMany(array $attribute);

    public function deleteMany(array $value);

    public function findWhereArray($field, $values);

}
