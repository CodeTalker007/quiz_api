<?php

namespace App\Http\Requests\Quiz;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class QuizRequest extends FormRequest
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
     * @return array<string, Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1000'],
            'publish' => ['required', 'boolean'],

            // question array validation
            'questions' => ['required', 'array'],
            'questions.*.statement' => ['required', 'string', 'max:500'],
            'questions.*.mandatory' => ['required', 'boolean'],
            'questions.*.correctOption' => ['required', 'string', 'max:255'],

            //question options array validation
            'questions.*.options' => ['required', 'array'],
            'questions.*.options.*.value' => ['required', 'string', 'max:255'],
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
            'title.required' => 'Quiz title is required',
            'title.string' => 'Quiz title must be string',
            'title.max' => 'Quiz title must not exceed 255 characters',
            'description.required' => 'Quiz description is required',
            'description.string' => 'Quiz description must be string',
            'description.max' => 'Quiz description must not exceed 1000 characters',
            'publish.required' => 'Quiz publish status is required',
            'description.boolean' => 'Quiz publish status must be boolean (true or false)',

            // question array validation error messages
            'questions.required' => "Question can't be empty",
            'questions.array' => "Question can't be empty",

            // question statement validation error messages
            'questions.*.statement.required' => 'Question Statement is required',
            'questions.*.statement.string' => 'Question Statement must be string',
            'questions.*.statement.max' => 'Question Statement must not exceed 500 characters',

            // question mandatory validation error messages
            'questions.*.mandatory.required' => 'Question Mandatory field is required',
            'questions.*.mandatory.boolean' => 'Question Mandatory field must be boolean (true or false)',
            'questions.*.mandatory.in' => 'Question Mandatory must be boolean (true or false)',

            // question correct option validation error messages
            'questions.*.correctOption.required' => 'There must be one correct option',
            'questions.*.correctOption.string' => 'Correct option must be string',
            'questions.*.correctOption.max' => 'Correct option must not exceed 255 characters',

            // question options array validation error messages
            'questions.*.options.required' => 'Question Options are required',
            'questions.*.options.array' => 'Question Options are required',

            // question options value validation error messages
            'questions.*.options.*.value.required' => 'Option value is required',
            'questions.*.options.*.value.string' => 'Option value must be string',
            'questions.*.options.*.value.max' => 'Option value should not exceed 255 characters',
        ];
    }
}
