<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestTopic;
use App\Repositories\Interfaces\TopicRepository;
use App\Repositories\Interfaces\QuestionRepository;
use App\Repositories\Interfaces\AnswerRepository;
use App\Services\ImageUploadService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Log;
use Illuminate\Support\Facades\Auth;

class AdminTopicController extends Controller
{
    protected $topicRepository;
    protected $questionRepository;
    protected $answerRepository;
    protected $imageUploadService;

    public function __construct(
        TopicRepository $topicRepository,
        QuestionRepository $questionRepository,
        AnswerRepository $answerRepository,
        ImageUploadService $imageUploadService
    )
    {
        $this->topicRepository = $topicRepository;
        $this->questionRepository = $questionRepository;
        $this->answerRepository = $answerRepository;
        $this->imageUploadService = $imageUploadService;
    }

    /**
     * Get list topic and route to list topic
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $topics = $this->topicRepository->search($search);
        if ($request->ajax()) {
            $html = view('admin.widgets.topics', compact('topics'))->render();

            return response()->json($html);
        }

        return view('admin.topic.index', compact('topics'));
    }

    /**
     * Route to create topic
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.topic.create');
    }

    /**
     * @param $id
     */
    public function show($id)
    {

    }
    /**
     * Insert new topic and return create topic page
     *
     * @param RequestTopic $request
     * @return RedirectResponse
     */
    public function store(RequestTopic $request)
    {
        if(Auth::user()->role == 0 && Auth::user()->user_status == 1) {
            $data = $request->all();
            if (isset($request->picture)) {
                $result = $this->imageUploadService->imageUpload($request->picture, null,'topics', 2048);
                if ($result) {
                    $data['picture'] = $result['path'];
                }
            }
            $this->topicRepository->create($data);
            toastr()->success(__('messages.success', ['name' => 'Create']));

            return redirect()
                ->route('topics.index')
                ->with('success', __('messages.success', ['name' => 'Create']));
        } else {
            toastr()->error(__('messages.permission'));

            return redirect()->back();
        }
    }

    /**
     * Get topic($id) and route to edit topic page
     *
     * @param $id
     * @return Factory|View
     */
    public function edit($id)
    {
        try {
            $topic = $this->topicRepository->getTopic($id);

            return view('admin.topic.update', compact('topic'));
        } catch (ModelNotFoundException $e) {
            Log::error('Edit topic not found ' . $e->getMessage());

            return view('errors.404');
        }
    }

    /**
     * Update topic and return update topic page
     *
     * @param RequestTopic $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(RequestTopic $request, $id)
    {
        try {
            if(Auth::user()->role == 0 && Auth::user()->user_status == 1) {
                $topic = $this->topicRepository->getTopic($id);
                $data = $request->all();
                if (isset($request->picture)) {
                    $result = $this->imageUploadService->imageUpload($request->picture, $topic->picture, 'topics', 2048);
                    if ($result) {
                        $data['picture'] = $result['path'];
                    }
                }
                $this->topicRepository->update($data, $id);
                toastr()->success(__('messages.success', ['name' => 'Edit']));

                return redirect()
                    ->route('topics.index')
                    ->with('success', __('messages.success', ['name' => 'Edit']));
            } else {
                toastr()->error(__('messages.permission'));
    
                return redirect()->back();
            }  
        } catch (ModelNotFoundException $e) {
            Log::error('Find topic error. ' . $e->getMessage());

            return view('errors.404');
        }
    }

    /**
     * Delete a topic
     *
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
       
        \DB::beginTransaction();
        try {
            if(Auth::user()->role == 0 && Auth::user()->user_status == 1) {
                $topic = $this->topicRepository->find($id);
                $questions = $this->questionRepository->findByField('topic_id', $id);
                $question_id_array = [];
                foreach($questions as $question) {
                    array_push($question_id_array, $question->id);
                }
                $this->topicRepository->deleteManyQuestionandAnswer($question_id_array);
                $topic->delete();
                \DB::commit();
                toastr()->success(__('messages.success', ['name' => 'Delete']));
    
                return redirect()->route('topics.index');
            } else {
                toastr()->error(__('messages.permission'));
    
                return redirect()->back();
            }
        } catch(ModelNotFoundException $exception) {
            \DB::rollback();
            Log::error("Error delete Topic ".$exception->getMessage());

            return view('errors.404');
        }
    }

    /**
     * function active topic
     *
     * @param $id
     * @return RedirectResponse
     */
    public function active($id)
    {
        if(Auth::user()->role == 0 && Auth::user()->user_status == 1) {
            $this->topicRepository->activeTopic($id);
            return redirect()->back();
        }
    }
}
