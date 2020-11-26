<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;

class QuestionnaireController extends Controller
{
    public function create() {
        return view('questionnaire.create');
    }

    public function store() {
        $data = request()->validate([
            'title' => 'required',
            'purpose' => 'required',
        ]);

        $data['user_id'] = auth()->user()->id;

        $questionnaire = Models\Questionnaire::create($data);

        return redirect('/questionnaires/'.$questionnaire->id);
    }

    public function show(Models\Questionnaire $questionnaire) {
        return view('questionnaire.show', compact('questionnaire'));
    }
}
