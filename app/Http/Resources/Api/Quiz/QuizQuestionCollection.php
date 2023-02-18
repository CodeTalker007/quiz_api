<?php

namespace App\Http\Resources\Api\Quiz;

use Illuminate\Http\Resources\Json\ResourceCollection;

class QuizQuestionCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray($request): array
    {
        return $this->collection->map(function ($question) {
            return [
                "id" => $question->id,
                "statement" => $question->statement,
                "mandatory" => $question->mandatory,
                "correctOption" => $question->correct_option,
                "options" => $question->options
            ];
        })->toArray($request);
    }
}
