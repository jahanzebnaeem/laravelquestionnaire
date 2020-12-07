<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;

class QuestionController extends Controller
{
    public function create(Models\Questionnaire $questionnaire) {
        return view('question.create', compact('questionnaire'));
    }

    public function store(Models\Questionnaire $questionnaire) {
        // dd(request()->all());
        $data = request()->validate([
            'question.question' => 'required',
            'answers.*.answer' => 'required',
        ]);

        // dd($data);

        $question = $questionnaire->questions()->create($data['question']);
        $question->answers()->createMany($data['answers']);

        return redirect('/questionnaires/'.$questionnaire->id);
    }

    public function destroy(Models\Questionnaire $questionnaire, Models\Question $question) {
        // dd($question->answers);
        $question->answers()->delete();
        $question->delete();

        return redirect($questionnaire->path());
    }
}
