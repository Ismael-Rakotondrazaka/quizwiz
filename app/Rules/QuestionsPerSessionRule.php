<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class QuestionsPerSessionRule implements ValidationRule
{
    public const QUESTIONS_PER_SESSION = 10;

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (count($value) !== self::QUESTIONS_PER_SESSION) {
            $fail('The number of questions per session must be ' . self::QUESTIONS_PER_SESSION . '.');
        }
    }
}
