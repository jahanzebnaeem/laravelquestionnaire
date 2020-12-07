<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;

class SurveyController extends Controller
{
    public function show(Models\Questionnaire $questionnaire, $slug) {
        // dd($slug);
        // dd($questionnaire);
        $questionnaire->load('questions.answers');
        return view('survey.show', compact('questionnaire'));
    }

    public function store(Models\Questionnaire $questionnaire) {
        // dd(request()->all());

        $data = request()->validate([
            'responses.*.answer_id' => 'required',
            'responses.*.question_id' => 'required',
            'survey.name' => 'required',
            'survey.email' => 'required|email',
        ]);

        // dd(request()->all());

        $survey = $questionnaire->surveys()->create($data['survey']);
        $survey->responses()->createMany($data['responses']);

        return 'Thank you';
    }
}
