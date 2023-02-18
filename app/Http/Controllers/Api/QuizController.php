<?php

namespace App\Http\Controllers\Api;

use App\Constants\ResponseConstant;
use App\Http\Controllers\Controller;
use App\Http\Requests\Quiz\AttemptQuizRequest;
use App\Http\Requests\Quiz\QuizRequest;
use App\Http\Resources\Api\Quiz\QuizResource;
use App\Models\Quiz;
use App\Services\QuizAttemptService;
use App\Services\QuizService;
use App\Traits\JsonResponseHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class QuizController extends Controller
{
    use JsonResponseHandler;

    private QuizService $service;
    private QuizAttemptService $quizAttemptService;

    public function __construct(QuizService $service, QuizAttemptService $quizAttemptService)
    {
        $this->service = $service;
        $this->quizAttemptService = $quizAttemptService;
    }

    public function store(QuizRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $quiz = $this->service->create($request->validated());
            DB::commit();
            $this->setData([
                'message' => ResponseConstant::RECORD_CREATED,
                'quiz' => new QuizResource($quiz)
            ]);
            $this->setStatusCode(Response::HTTP_CREATED);
        } catch (\Exception $exception) {
            DB::rollBack();
            $this->handelException($exception);
        }

        return $this->returnJsonResponse();
    }

    /**
     * Attempt Quiz
     *
     * @param AttemptQuizRequest $request
     * @param Quiz $quiz
     * @return JsonResponse
     */
    public function attempt(AttemptQuizRequest $request, Quiz $quiz): JsonResponse
    {
        try {
            DB::beginTransaction();
            $this->quizAttemptService->create($quiz->id, $request->validated());
        DB::commit();
            $this->setData([
                'message' => ResponseConstant::ATTEMPT_SUCCESSFULLY
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            $this->handelException($exception);
        }

        return $this->returnJsonResponse();
    }
}
