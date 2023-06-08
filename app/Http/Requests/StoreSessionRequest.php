<?php

namespace App\Http\Requests;

use App\Enums\QuestionDifficultyEnum;
use App\Rules\QuestionsPerSessionRule;
use App\Rules\RelatedQuestionAnswerRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreSessionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'answers' => ['required', 'array', new QuestionsPerSessionRule(), new RelatedQuestionAnswerRule()],
            'answers.*.question_id' => 'required|integer|exists:questions,id',
            'answers.*.answer_id' => 'nullable|integer',
            'difficulty' => ['required', new Enum(QuestionDifficultyEnum::class)]
        ];
    }
}
