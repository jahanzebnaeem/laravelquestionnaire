<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;

class QuestionnaireController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function create() {
        return view('questionnaire.create');
    }

    public function store() {
        $data = request()->validate([
            'title' => 'required',
            'purpose' => 'required',
        ]);

        // $data['user_id'] = auth()->user()->id;

        // $questionnaire = Models\Questionnaire::create($data);

        $questionnaire = auth()->user()->questionnaires()->create($data);

        return redirect('/questionnaires/'.$questionnaire->id);
    }

    public function show(Models\Questionnaire $questionnaire) {
        // dd($questionnaire);
        $questionnaire->load('questions.answers');
        // dd($questionnaire);

        return view('questionnaire.show', compact('questionnaire'));
    }
}
