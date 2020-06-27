<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\TopicRepository;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    protected $topicRepository;

    /**
     * SearchController constructor.
     *
     * @param TopicRepository $topicRepository
     */
    public function __construct(TopicRepository $topicRepository)
    {
        $this->topicRepository = $topicRepository;
    }

    /**
     * Search topic
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $topics = $this->topicRepository->search($search);
        $data = [
            'topic_count' => $topics->total(),
            'key_word' => $request->get('search'),
        ];

        return view('index', compact('topics', 'data'));
    }
}
