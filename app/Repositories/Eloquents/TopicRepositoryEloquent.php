<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\TopicRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Models\Topic;

/**
 * Class TopicRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TopicRepositoryEloquent extends BaseRepository implements TopicRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Topic::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * query first record if exist.
     *
     * @param $field
     * @param $value
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function firstByField($field, $value)
    {
        $this->applyCriteria();
        $this->applyScope();
        $model = $this->model->where($field, '=', $value)->firstOrFail();
        $this->resetModel();

        return $this->parserResult($model);
    }

    /**
     * Take the limit record latest
     *
     * @param $limit
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function takeLatest($limit = null)
    {
        $this->applyCriteria();
        $this->applyScope();
        $limit = is_null($limit) ? Topic::LIMIT_TOPIC : $limit;
        $model = $this->model->whereTopicStatus(Topic::STATUS_PUBLIC)->take($limit)->latest()->get();
        $this->resetModel();

        return $this->parserResult($model);
    }

    /**
     * Count Topics
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
    * get list topic
    */
    public function getTopics()
    {
        $topics = $this->model->orderBy('id', 'desc')->get();
        
        return $topics;
    }

    /**
     * get topic by id
     */
    public function getTopic($id)
    {
        $topic = $this->model->find($id);

        return $topic;
    }

    /**
     * Get all record latest using paginate
     *
     * @param null $limit
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function paginateLatest($limit = null)
    {
        $this->applyCriteria();
        $this->applyScope();
        $limit = is_null($limit) ? Topic::LIMIT_TOPIC : $limit;
        $model = $this->model::query()->whereTopicStatus(Topic::STATUS_PUBLIC)->latest()->paginate($limit);
        $this->resetModel();

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
            $model = $this->model::query()->latest()->paginate(Topic::LIMIT_TOPIC);
        } else {
            $model = $this->model->search($term)->latest()->paginate(Topic::LIMIT_TOPIC);
        }
        $this->resetModel();

        return $this->parserResult($model);
    }

    /**
     * @param $id
     */
    public function activeTopic($id)
    {
        $topic = $this->getTopic($id);
        $topic->topic_status = $topic->topic_status == 0 ?  1 :  0;
        $topic->save();
    }

    /**
     * @param $id
     * delete question va cau hoi lien quan khi del topic
     */
    public function deleteManyQuestionandAnswer($question_id_array)
    {
        \DB::table('questions')->whereIn('id', $question_id_array)->delete();
        \DB::table('answers')->whereIn('question_id', $question_id_array)->delete();
    }
}
