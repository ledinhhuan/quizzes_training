<?php

namespace App\Repositories\Eloquents;

use App\Models\User;
use App\Repositories\Interfaces\UserRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class TopicRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Count Users
     *
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function count()
    {
        $this->applyCriteria();
        $this->applyScope();
        $model = $this->model::query()->count();
        $this->resetModel();

        return $this->parserResult($model);
    }

    /**
     * function get list question
     */
    public function getUsers()
    {
        $users = $this->model->orderBy('id', 'desc')->get();

        return $users;
    }

    /**
     * get user by id
     */
    public function getUser($id)
    {
        $user = $this->model->find($id);

        return $user;
    }

    /**
     * @param $id
     */
    public function activeUser($id)
    {
        $user = $this->getUser($id);
        $user->user_status = $user->user_status == 0 ?  1 :  0;
        $user->save();
    }

    /**
     * Search full text with model
     *
     * @param $term
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function search($term)
    {
        if (is_null($term)) {
            $model = $this->model::query()->latest()->paginate(User::LIMIT_USER);
        } else {
            $model = $this->model::query()->search($term)->latest()->paginate(User::LIMIT_USER);
        }

        return $this->parserResult($model);
    }

}
