<?php

namespace App\Repositories\Eloquents;

use App\Models\Answer;
use App\Repositories\Interfaces\AnswerRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
/**
 * Class TopicRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AnswerRepositoryEloquent extends BaseRepository implements AnswerRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Answer::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Insert many record
     *
     * @param array $attribute
     * @return mixed
     */
    public function insertMany(array $attribute)
    {
        $model = $this->model::query()->insert($attribute);

        return $this->parserResult($model);
    }

    /**
     * @param array $value
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function deleteMany(array $value)
    {
        $query = \DB::table('answers')->whereIn('id', $value)->delete();

        return $query;
    }

    /**
     * Find question to array pluck id
     *
     * @param $field
     * @param $values
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function findWhereArray($field, $values)
    {
        $this->applyScope();
        $model = $this->model::query()->where($field, $values)->pluck('id')->toArray();
        $this->resetModel();

        return $this->parserResult($model);
    }
}
