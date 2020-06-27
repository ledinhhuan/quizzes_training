<?php

namespace App\Repositories\Eloquents;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\ResultRepository;
use App\Models\Result;

/**
 * Class ResultRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class ResultRepositoryEloquent extends BaseRepository implements ResultRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Result::class;
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
}
