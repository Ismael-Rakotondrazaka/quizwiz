<?php

namespace App\Http\Controllers;

use App\Http\Requests\StartSessionRequest;
use App\Http\Requests\StoreSessionRequest;
use App\Http\Requests\UpdateSessionRequest;
use App\Models\Question;
use App\Models\Session;
use App\Rules\QuestionsPerSessionRule;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SessionController extends Controller
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
    public function create()
    {
        return Inertia::render(
            'Sessions/CreateSession',
            [
                'difficulty' => "",
                'questions' => [],
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function start(StartSessionRequest $request)
    {
        $validated = $request->safe()->only('difficulty');

        $questions = Question::inRandomOrder()
            ->with('answers')
            ->where('difficulty', $validated['difficulty'])
            ->limit(QuestionsPerSessionRule::QUESTIONS_PER_SESSION)
            ->get();

        return Inertia::render('Sessions/CreateSession', [
            'difficulty' => $validated['difficulty'],
            'questions' => $questions,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSessionRequest $request)
    {
        $validated = $request->safe()->only(['answers', 'difficulty']);

        // get all the questionsIds
        $questionsIds = array_map(function ($answer) {
            return $answer['question_id'];
        }, $validated['answers']);

        // create an associative array with questionId as key and the answerId (or null) as a value
        $questionAnswer = [];
        foreach ($validated['answers'] as $pair) {
            $questionAnswer[$pair['question_id']] = $pair['answer_id'];
        }

        // get all the questions with their correct answers
        $questions = Question::whereIn('id', $questionsIds)->with('correctAnswers')->get();

        $score = 0;

        foreach ($questions as $question) {
            $isAnswerCorrect = false;

            // check if the answer given by the user is within the correct answers
            foreach ($question['correctAnswers'] as $correctAnswer) {
                if ($correctAnswer['id'] === $questionAnswer[$question['id']]) {
                    $isAnswerCorrect = true;
                    break;
                }
            }

            if ($isAnswerCorrect) {
                $score++;
            }
        }

        $request->user()->sessions()->create([
            'score' => $score,
            'difficulty' => $validated['difficulty'],
        ]);

        return redirect()->route('sessions.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Session $session)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Session $session)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSessionRequest $request, Session $session)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Session $session)
    {
        //
    }
}
