<?php

namespace App\Services;

use App\Repositories\QuizRepository;
use Illuminate\Database\Eloquent\Model;

class QuizService extends BaseService
{
    private QuizQuestionService $questionService;

    /**
     * Service Constructor
     */
    public function __construct(QuizRepository $repository, QuizQuestionService $questionService)
    {
        parent::__construct($repository);
        $this->questionService = $questionService;
    }

    /**
     * Create New Quiz
     */
    public function create(array $data): ?Model
    {
        $quiz = $this->repository->create($this->prepareQuizPayload(
            $data['title'],
            $data['description'],
            $data['publish']
        ));

        $this->questionService->create($quiz->id, $data["questions"]);

        return $quiz;
    }

    /**
     * Prepare Quiz payload for insertion or updating
     *
     * @param string $title
     * @param string $description
     * @param bool $publish
     * @return array
     */
    private function prepareQuizPayload(string $title, string $description = '', bool $publish = false): array
    {
        return [
            'title' => $title,
            'description' => $description,
            'publish' => $publish,
        ];
    }
}
