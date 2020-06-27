<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Interfaces\TopicRepository;
use http\Env\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\RequestQuestion;
use App\Http\Requests\RequestAnswer;
use App\Repositories\Interfaces\QuestionRepository;
use App\Repositories\Interfaces\AnswerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminQuestionController extends Controller
{
    protected $questionRepository;
    protected $answerRepository;
    protected $topicRepository;

    public function __construct(
        QuestionRepository $questionRepository,
        AnswerRepository $answerRepository,
        TopicRepository $topicRepository
    )
    {
        $this->questionRepository = $questionRepository;
        $this->answerRepository = $answerRepository;
        $this->topicRepository = $topicRepository;
    }

    /**
     * get list question and route to list question
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $level = $request->get('level');
        
        $questions = $this->questionRepository->search($search, $level);
        if($request->ajax()) {
            $html = view('admin.widgets.questions', compact('questions'))->render();
            
            return response()->json($html);
        }

        return view('admin.question.index', compact('questions'));
    }

    /**
     * Create question
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $topics = $this->topicRepository->orderBy('id', 'desc')->get();

        return view('admin.question.create', compact('topics'));

    }

    /**
     * Store created question
     *
     * @param RequestQuestion $requestQuestion
     * @param RequestAnswer $requestAnswer
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function store(RequestQuestion $requestQuestion, RequestAnswer $requestAnswer)
    {
        \DB::beginTransaction();
        try {
            if(Auth::user()->role == 0 && Auth::user()->user_status == 1) {
                $question = $this->questionRepository->create($requestQuestion->all());
                $answers = $requestAnswer->get('answer');

                $data = [];
                
                if (isset($answers)) {
                    foreach ($answers as $key => $answer) {
                        $isCorrect = (int)$requestAnswer->input('is_correct') == ($key + 1) ? 1 : 0;
                        $data[] = [
                            'question_id' => $question->id,
                            'answer' => $answer, 'is_correct' => $isCorrect,
                            'created_at' => \now(),
                            'updated_at' => \now(),
                        ];
                    }
                    $this->answerRepository->insertMany($data);
                    \DB::commit();
                    toastr()->success(__('messages.success', ['name' => 'Create Question']));
                    return redirect()->route('questions.index');
                }
            } else {
                toastr()->error(__('messages.permission'));
    
                return redirect()->back();
            }
        } catch (\Exception $exception) {
            \DB::rollback();
            \Log::error("Error create question and answer" . $exception->getMessage());

            return view('errors.404');
        }
    }

    /**
     * get info question to show detail page
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $question = $this->getQuestion($id);

        return view('admin.question.view', compact('question'));
    }

    /**
     * get question($id) and route to edit question page
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $question = $this->questionRepository->with('answers')->find($id);
        $topics = $this->topicRepository->orderBy('id', 'desc')->get();

        return view('admin.question.update', compact('question', 'topics'));
    }

    /**
     * Update topic and return update topic page
     *
     * @param RequestQuestion $requestQuestion
     * @param RequestAnswer $requestAnswer
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function update(RequestQuestion $requestQuestion, RequestAnswer $requestAnswer, $id)
    {
        \DB::beginTransaction();
        try {
            if(Auth::user()->role == 0 && Auth::user()->user_status == 1) {
                $question = $this->questionRepository->update($requestQuestion->all(), $id);

                $answerId = $this->answerRepository->findWhereArray('question_id', $id);
                $answers = $requestAnswer->get('answer');
                $id = $requestAnswer->get('id');

                if (isset($answers)) {
                    foreach ($answers as $key => $answer) {
                        $isCorrect = (int)$requestAnswer->input('is_correct') == ($key + 1) ? 1 : 0;
                        $data = [
                            'question_id' => $question->id,
                            'answer' => $answer,
                            'is_correct' => $isCorrect,
                        ];

                        if (empty(array_diff($answerId, $id))) {
                            if (!empty($answerId[$key])) {
                                $this->answerRepository->update($data, $answerId[$key]);
                            } else {
                                $this->answerRepository->create($data);
                            }
                        } else {
                            $this->answerRepository->deleteMany(array_diff($answerId, $id));
                        }
                    }
                    \DB::commit();
                    toastr()->success(__('messages.success', ['name' => 'Update Question']));
                }

                return redirect()->route('questions.index');
            } else {
                toastr()->error(__('messages.permission'));
    
                return redirect()->back();
            }
        } catch (ModelNotFoundException $exception) {
            \DB::rollback();
            \Log::error("Error update Question" . $exception->getMessage());

            return view('errors.404');
        }
    }

    /**
     * function delete question and relatedAnswers
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function destroy($id)
    {
        \DB::beginTransaction();
        try {
            if(Auth::user()->role == 0 && Auth::user()->user_status == 1) {
                $answers = $this->answerRepository->findByField('question_id', $id);
                if (count($answers)) {
                    $this->answerRepository->deleteMany($answers->pluck('id')->toArray());
                }
                $this->questionRepository->delete($id);
                toastr()->success(__('messages.success', ['name' => 'Delete Question']));
                \DB::commit();

                return redirect()->route('questions.index');
            } else {
                toastr()->error(__('messages.permission'));
    
                return redirect()->back();
            }
        } catch (ModelNotFoundException $exception) {
            \DB::rollback();

            return view('errors.404');
        }
    }
    
    /**
     * get question by id
     */
    public function getQuestion($id)
    {
        $question = $this->questionRepository->with('answers')->find($id);

        return $question;
    }
}
