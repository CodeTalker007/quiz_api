<?php

namespace App\Services;

use App\Repositories\QuizAttemptRepository;
use Illuminate\Database\Eloquent\Model;

class QuizAttemptService extends BaseService
{
    public function __construct(QuizAttemptRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * Create new quiz attempt
     *
     * @param int $quizId
     * @param array $data
     * @return Model|null
     */
    public function create(int $quizId, array $data): ?Model
    {
        return $this->repository->create($this->preparePayload($quizId, $data));
    }

    /**
     * Prepare Payload
     *
     * @param int $quizId
     * @param array $questions
     * @return array
     */
    public function preparePayload(int $quizId, array $questions): array
    {
        return [
            "quiz_id" => $quizId,
            "data" => $questions
        ];
    }
}
