<?php

namespace App\Http\Controllers\Home;

use App\Models\Topic;
use App\Repositories\Interfaces\TopicRepository;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    protected $topicRepository;

    /**
     * TopicController constructor.
     * @param TopicRepository $topicRepository
     */
    public function __construct(TopicRepository $topicRepository)
    {
        $this->topicRepository = $topicRepository;
    }

    /**
     * Show all topic
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     * @throws \Throwable
     */
    public function showAllTopic(Request $request)
    {
        $topics = $this->topicRepository->paginateLatest();
        if ($request->has('page') && $request->ajax()) {
            $view = view('widgets.topics', compact('topics'))->render();

            return \response()->json([
                'html'=>$view,
                'page'=>$topics->currentPage(),
                'hasMorePages'=>$topics->hasMorePages(),
            ]);
        }

        return view('topics.index', compact('topics'));
    }
}
