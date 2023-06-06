<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Models\Question;
use Inertia\Inertia;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questionsPaginated = Question::paginate(40);
        $questionsPaginated->onEachSide(2)->links();

        return Inertia::render('Questions/IndexQuestion', [
            'questionsPaginated' => $questionsPaginated,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Questions/CreateQuestion');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQuestionRequest $request)
    {
        $validated = $request->safe()->only(['content', 'difficulty', 'answers']);

        $question = Question::create([
            'content' => $validated['content'],
            'difficulty' => $validated['difficulty'],
        ]);

        $question->answers()->createMany($validated['answers']);

        return redirect()->route('questions.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        $question->load('answers');

        return Inertia::render('Questions/ShowQuestion', [
            'question' => $question,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        $question->load('answers');

        return Inertia::render('Questions/EditQuestion', [
            'question' => $question,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQuestionRequest $request, Question $question)
    {
        $validated = $request->safe()->only(['content', 'difficulty']);

        $question->update([
            'content' => $validated['content'],
            'difficulty' => $validated['difficulty'],
        ]);

        return redirect()->route('questions.show', $question->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        //
    }
}
