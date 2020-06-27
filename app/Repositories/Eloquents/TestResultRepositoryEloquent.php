<?php

namespace App\Repositories\Eloquents;

use App\Criteria\UserCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\TestResultRepository;
use App\Models\TestResult;

/**
 * Class TestResultRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class TestResultRepositoryEloquent extends BaseRepository implements TestResultRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TestResult::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(UserCriteria::class);
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Group by results with created at
     *
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function groupByResults()
    {
        $this->applyCriteria();
        $this->applyScope();
        $model = $this->model->with('topic')
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function ($value) {
                return \Carbon\Carbon::parse($value->created_at)->isoFormat('MMMM Do YYYY');
            });
        $this->resetModel();

        return $this->parserResult($model);
    }
}
