<?php

namespace App\Http\Requests;

use App\Enums\QuestionDifficultyEnum;
use App\Rules\MinCorrectAnswerRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreQuestionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'content' => 'required|string',
            'difficulty' => ['required', new Enum(QuestionDifficultyEnum::class)],
            'answers' => ['required', 'array', 'min:4', new MinCorrectAnswerRule()],
            'answers.*.content' => 'required|string',
            'answers.*.is_correct' => 'required|boolean',
        ];
    }
}
