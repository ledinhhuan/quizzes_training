<?php

namespace App\Repositories\Interfaces;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface TopicRepository.
 *
 * @package namespace App\Repositories;
 */
interface TopicRepository extends RepositoryInterface
{
    public function firstByField($field, $value);

    public function takeLatest($limit = null);

    public function count();

    public function paginateLatest($limit = null);

    public function search($term);

    public function getTopic($id);

    public function activeTopic($id);

    public function deleteManyQuestionandAnswer($question_id_array);
}
