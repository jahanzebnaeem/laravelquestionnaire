<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [Controllers\HomeController::class, 'index'])->name('home');

Route::get('/questionnaires/create', [Controllers\QuestionnaireController::class, 'create']);
Route::post('/questionnaires', [Controllers\QuestionnaireController::class, 'store']);
Route::get('/questionnaires/{questionnaire}', [Controllers\QuestionnaireController::class, 'show']);

Route::get('/questionnaires/{questionnaire}/questions/create', [Controllers\QuestionController::class, 'create']);
Route::post('/questionnaires/{questionnaire}/questions', [Controllers\QuestionController::class, 'store']);

