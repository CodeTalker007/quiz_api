<?php

namespace App\Services;

use App\Repositories\QuizQuestionRepository;

class QuizQuestionService extends BaseService
{
    /**
     * Service Constructor
     */
    public function __construct(QuizQuestionRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * Create Question for quiz
     *
     * @param int $quizId
     * @param array $questions
     * @return void
     */
    public function create(int $quizId, array $questions): void
    {
        foreach ($questions as $question) {
            $this->repository->create($this->preparePayload(
                $quizId,
                $question["statement"],
                $question["mandatory"],
                $question["correctOption"],
                $question["options"]
            ));
        }
    }

    /**
     * Prepare Quiz payload for insertion or updating
     *
     * @param int $quizId
     * @param string $statement
     * @param bool $mandatory
     * @param string $correctOption
     * @param array $options
     * @return array
     */
    private function preparePayload(
        int    $quizId,
        string $statement,
        bool   $mandatory,
        string $correctOption,
        array  $options
    ): array
    {
        return [
            "quiz_id" => $quizId,
            "statement" => $statement,
            "mandatory" => $mandatory,
            "correct_option" => $correctOption,
            "options" => $options
        ];
    }
}
