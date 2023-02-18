<?php

namespace App\Http\Resources\Api\Quiz;

use Illuminate\Http\Resources\Json\JsonResource;

class QuizResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            "title" => $this->id,
            "description" => $this->description,
            "publish" => $this->publish,
            "questions" => new QuizQuestionCollection($this->questions)
        ];
    }
}
