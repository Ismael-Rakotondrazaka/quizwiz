<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnswerRequest;
use App\Http\Requests\UpdateAnswerRequest;
use App\Models\Answer;
use App\Models\Question;
use App\Rules\MinCorrectAnswerRule;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Question $question)
    {
        $question->load('answers');

        return Inertia::render('Answers/CreateAnswer', [
            'question' => $question,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnswerRequest $request, Question $question)
    {
        $validated = $request->safe()->only(['content', 'is_correct']);

        $question->answers()->create([
            'content' => $validated['content'],
            'is_correct' => $validated['is_correct'],
        ]);

        return redirect()->route('questions.show', $question);
    }

    /**
     * Display the specified resource.
     */
    public function show(Answer $answer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question, Answer $answer)
    {
        $this->authorize('update', [$answer, $question]);

        return Inertia::render('Answers/EditAnswer', [
            'question' => $question,
            'answer' => $answer,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnswerRequest $request, Question $question, Answer $answer)
    {
        $this->authorize('update', [$answer, $question]);

        $validated = $request->safe()->only(['content', 'is_correct']);

        $minCorrectAnswerValidator = Validator::make($validated, [
            'is_correct' => [function ($attribute, $value, $fail) use ($question) {
                /*
                if the answer is not correct,
                then we need to check if there is at least one correct answer
                */
                if ($value === false) {
                    $correctAnswersCount = $question->answers()->where('is_correct', true)->count();

                    if ($correctAnswersCount - 1 < MinCorrectAnswerRule::MIN_CORRECT_ANSWER) {
                        $fail('At least one correct answer is required.');
                    }
                }
            }],
        ]);


        if ($minCorrectAnswerValidator->fails()) {
            // Handle validation errors, redirect back with errors
            return redirect()->back()->withErrors($minCorrectAnswerValidator)->withInput();
        }

        $answer->update([
            'content' => $validated['content'],
            'is_correct' => $validated['is_correct'],
        ]);

        return redirect()->route('questions.show', $question);
    }

    /**
     * Show the form for deleting the specified resource.
     */
    public function delete(Question $question, Answer $answer)
    {
        $this->authorize('forceDelete', [$answer, $question]);

        return Inertia::render('Answers/DeleteAnswer', [
            'question' => $question,
            'answer' => $answer,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question, Answer $answer)
    {
        $this->authorize('forceDelete', [$answer, $question]);

        $minCorrectAnswerValidator = Validator::make($answer->getOriginal(), [
            'is_correct' => [function ($attribute, $value, $fail) use ($question) {
                $answersCount = $question->answers()->count();

                if ($answersCount <= 4) {
                    $fail('At least four answers are required.');
                } else if ($value === true) {
                    /*
                    if the answer is correct,
                    then we need to check if there is at least one correct answer remaining
                    */
                    $correctAnswersCount = $question->answers()->where('is_correct', true)->count();

                    if ($correctAnswersCount - 1 < MinCorrectAnswerRule::MIN_CORRECT_ANSWER) {
                        $fail('At least one correct answer is required.');
                    }
                }
            }],
        ]);

        if ($minCorrectAnswerValidator->fails()) {
            // Handle validation errors, redirect back with errors
            return redirect()->back()->withErrors($minCorrectAnswerValidator)->withInput();
        }

        $answer->delete();

        return redirect()->route('questions.show', $question);
    }
}
