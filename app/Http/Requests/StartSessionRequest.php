<?php

namespace App\Http\Requests;

use App\Enums\QuestionDifficultyEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StartSessionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'difficulty' => ['required', new Enum(QuestionDifficultyEnum::class)],
        ];
    }
}
