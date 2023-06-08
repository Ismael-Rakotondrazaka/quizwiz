<?php

namespace App\Rules;

use App\Models\Answer;
use App\Models\Question;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class RelatedQuestionAnswerRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $validationErrorMessage = '';

        foreach ($value as $pair) {
            $question_id =  $pair['question_id'];
            $answer_id = $pair['answer_id'];

            if ($answer_id) {
                // exists and match with the question_id
                $isAnswerExists = Answer::where('id', $answer_id)->where('question_id', $question_id)->exists();

                if (!$isAnswerExists) {
                    $validationErrorMessage = 'One or more question and answer pairs are invalid.';

                    break;
                }
            } else {
                // if the question exists, but not the answer, it will be considered as a valid answer, but not the correct one
                $isQuestionExists = Question::where('id', $question_id);

                if (!$isQuestionExists) {
                    $validationErrorMessage = 'One or more question and answer pairs are invalid.';

                    break;
                }
            }
        }

        if ($validationErrorMessage !== '') {
            $fail($validationErrorMessage);
        }
    }
}
