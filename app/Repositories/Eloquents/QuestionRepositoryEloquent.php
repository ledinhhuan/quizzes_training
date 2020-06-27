<?php

namespace App\Repositories\Eloquents;

use App\Models\Question;
use App\Repositories\Interfaces\QuestionRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
/**
 * Class TopicRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class QuestionRepositoryEloquent extends BaseRepository implements QuestionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Question::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Count Questions
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
     * Get list question relationship topic order by desc
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getListQuestion()
    {
        $questions = $this->model->with('topic')->orderByDesc('id')->paginate(Question::LIMIT_QUESTION);

        return $questions;
    }

    /**
     * Random question and order
     *
     * @param array $where
     * @return mixed
     */
    public function randomOrder(array $where)
    {
        $this->applyConditions($where);
        $model = $this->model
            ->with(['answers' => function($q) {
                $q->inRandomOrder();
            }])
            ->inRandomOrder()
            ->limit(Question::LIMIT_QUESTION)
            ->get();

        return $this->parserResult($model);
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
            $model = $this->getListQuestion();
        } else {
            $model = $this->model::where('content', 'like', '%'.$term.'%')->paginate();
        }
        return $this->parserResult($model);
    }
}
