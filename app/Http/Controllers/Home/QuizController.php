<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\AnswerRepository;
use App\Repositories\Interfaces\QuestionRepository;
use App\Repositories\Interfaces\ResultRepository;
use App\Repositories\Interfaces\TestResultRepository;
use App\Repositories\Interfaces\TopicRepository;
use App\Services\QuizzService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Cache;

class QuizController extends Controller
{
    protected $topicRepository;
    protected $questionRepository;
    protected $resultRepository;
    protected $answerRepository;
    protected $testResultRepository;
    protected $quizzService;

    /**
     * QuizController constructor.
     *
     * @param TopicRepository $topicRepository
     * @param QuestionRepository $questionRepository
     * @param AnswerRepository $answerRepository
     * @param ResultRepository $resultRepository
     * @param TestResultRepository $testResultRepository
     * @param QuizzService $quizzService
     */
    public function __construct(
        TopicRepository $topicRepository,
        QuestionRepository $questionRepository,
        AnswerRepository $answerRepository,
        ResultRepository $resultRepository,
        TestResultRepository $testResultRepository,
        QuizzService $quizzService
    )
    {
        $this->topicRepository = $topicRepository;
        $this->questionRepository = $questionRepository;
        $this->answerRepository = $answerRepository;
        $this->resultRepository = $resultRepository;
        $this->testResultRepository = $testResultRepository;
        $this->quizzService = $quizzService;
    }

    /**
     * Show quizz test
     *
     * @param $slug
     * @param $level
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showQuizz($slug, $level)
    {
        try {
            $topic = $this->topicRepository->firstByField('slug', $slug);
            //caching redis
            $cacheKey = md5('show_quizz' . $slug . $level);
            if (Cache::has($cacheKey)){
                $questions = Cache::get($cacheKey);
            } else {
                $questions =  $this->questionRepository->randomOrder([
                    'level' => $level,
                    'topic_id' => $topic->id,
                ]);
                if (!$questions->isEmpty()) {
                    Cache::put($cacheKey, $questions);
                } else {
                    return view('errors.404');
                }
            }

            return view('quizzes.show', compact('topic', 'questions', 'cacheKey'));
        } catch (ModelNotFoundException $e) {
            \Log::error($e->getMessage());

            return view('errors.404');
        }
    }

    /**
     * Do quizz test when user submit
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function doQuizz(Request $request)
    {
        \DB::beginTransaction();
        try {
            $questions = $request->input('questions.*');
            $userId = \Auth::id();

            $testResult = $this->testResultRepository->create([
                'user_id' => isset($userId) ? $userId : null,
                'topic_id' => $request->input('topic-id'),
                'level' => $request->input('level'),
                'result' => 0,
            ]);
            /*** Save Many question with one query ***/
            $this->resultRepository->insertMany($this->quizzService->dataQuestions($request, $questions, $testResult));

            /*** Calculate rersult when submit ***/
            $answers = $request->input('answers.*');
            if (!is_null($answers)) {
                $answers = $this->answerRepository->find($request->input('answers.*'));
            }
            $testResult->update([
                'result' => $this->quizzService->calculateResult($answers),
            ]);

            //remove cache when submit
            if ($request->has('key')) {
                Cache::forget($request->get('key'));
            }
            \DB::commit();

            return redirect()->route('result.show', $testResult->id);
        } catch (\Exception $e) {
            \Log::error('Summit quizz error: ' . $e->getMessage());
            \DB::rollBack();

            return view('errors.404');
        }
    }
}
