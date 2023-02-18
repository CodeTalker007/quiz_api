<?php

namespace App\Http\Requests\Quiz;

use Illuminate\Foundation\Http\FormRequest;

class AttemptQuizRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            "questions" => ["required", "array"],
            "questions.*.questionId" => ["required", "exists:quiz_questions,id"],
            "questions.*.attempt" => ["required", "boolean"],
            "questions.*.selectedAnswer" => ["nullable", "string"]
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return string[]
     */
    public function messages(): array
    {
        return [
            // question array validation error messages
            'questions.required' => "Question can't be empty",
            'questions.array' => "Question can't be empty",

            // question statement validation error messages
            'questions.*.questionId.required' => 'Question is required',
            'questions.*.statement.exists' => 'Question don\'t exist',

            // question mandatory validation error messages
            'questions.*.attempt.required' => 'Question attempt field is required',
            'questions.*.attempt.boolean' => 'Question attempt field must be boolean (true or false)',

            // question correct option validation error messages
            'questions.*.selectedAnswer.string' => 'Selected answer must be string',
        ];
    }
}
