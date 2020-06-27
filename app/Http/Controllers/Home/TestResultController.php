<?php

namespace App\Http\Controllers\Home;

use App\Criteria\UserCriteria;
use App\Repositories\Interfaces\ResultRepository;
use App\Repositories\Interfaces\TestResultRepository;
use App\Services\ChartService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TestResultController extends Controller
{
    protected $resultRepository;
    protected $testResultRepository;
    protected $chartService;

    public function __construct(
        ResultRepository $resultRepository,
        TestResultRepository $testResultRepository,
        ChartService $chartService
    )
    {
        $this->resultRepository = $resultRepository;
        $this->testResultRepository = $testResultRepository;
        $this->chartService = $chartService;
    }

    /**
     * Show result when submit
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showResult($id)
    {
        try {
            $testResult = $this->testResultRepository->find($id);
            $results = $this->resultRepository->with('question')
                    ->with('question.answers')
                    ->findWhere(['test_result_id' => $testResult->id]);
            $chart = DB::table('test_results')
                ->select('result')
                ->where(['topic_id' => $testResult->topic_id])
                ->where(['level' => $testResult->getOriginal('level')])
                ->groupBy('id')
                ->pluck('result');

            $partition = $this->chartService->partitionLevel($chart);
            $calculateChart = json_encode($this->chartService->calculateLevel($partition, $chart));

            return view('results.show', compact('testResult', 'results', 'calculateChart'));
        } catch (ModelNotFoundException $e) {
            \Log::info('Show result error ' . $e->getMessage());
        }
    }

    /**
     * Group by result with day
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function historyResults()
    {
        $testResults = $this->testResultRepository->groupByResults();

        return view('results.history_result', compact('testResults'));
    }

    /**
     * Delete Test Result
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function deleteTestResult($id)
    {
        try {
            $this->testResultRepository->pushCriteria(UserCriteria::class);
            $testResult = $this->testResultRepository->find($id);
            $testResult->delete();

            return \response()->json($testResult);
        } catch (ModelNotFoundException $e) {
            \Log::error('Delete Result History Error: ' . $e->getMessage());

            return view('errors.404');
        }
    }
}
