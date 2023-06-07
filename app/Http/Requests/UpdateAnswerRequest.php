<?php

namespace App\Http\Requests;

use App\Enums\QuestionDifficultyEnum;
use App\Rules\MinCorrectAnswerRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateAnswerRequest extends FormRequest
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
            'is_correct' => 'required|boolean',
        ];
    }
}
