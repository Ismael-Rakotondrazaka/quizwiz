<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MinCorrectAnswerRule implements ValidationRule
{
    public const MIN_CORRECT_ANSWER = 1;

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Count the number of correct answers
        $correctAnswersCount = collect($value)->where('is_correct', true)->count();

        if ($correctAnswersCount < self::MIN_CORRECT_ANSWER) {
            $fail('At least one correct answer is required.');
        }
    }
}
