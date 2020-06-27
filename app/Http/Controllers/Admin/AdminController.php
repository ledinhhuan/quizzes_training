<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\QuestionRepository;
use App\Repositories\Interfaces\TopicRepository;
use App\Repositories\Interfaces\UserRepository;

class AdminController extends Controller
{
    protected $topicRepository;
    protected $questionRepository;
    protected $userRepository;

    /**
     * AdminController constructor.
     * @param TopicRepository $topicRepository
     * @param QuestionRepository $questionRepository
     * @param UserRepository $userRepository
     */
    public function __construct(
        TopicRepository $topicRepository,
        QuestionRepository $questionRepository,
        UserRepository $userRepository
    )
    {
        $this->topicRepository = $topicRepository;
        $this->questionRepository = $questionRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Get data and return index page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $topicsNumber = $this->topicRepository->count();
        $questionsNumber = $this->questionRepository->count();
        $usersNumber = $this->userRepository->count();

        return view('admin.index', compact('topicsNumber', 'questionsNumber', 'usersNumber'));
    }
}
