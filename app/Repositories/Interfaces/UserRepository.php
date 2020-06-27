<?php

namespace App\Repositories\Interfaces;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface TopicRepository.
 *
 * @package namespace App\Repositories;
 */
interface UserRepository extends RepositoryInterface
{
    public function count();

    public function getUsers();

    public function getUser($id);

    public function activeUser($id);

    public function search($term);
}
