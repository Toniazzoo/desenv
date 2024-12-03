<?php

use App\Http\Controllers\AlunoController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\TurmaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
Route::get('/aluno', [AlunoController::class,'index'])
    ->name('aluno.form');
*/
Route::post('aluno/search',
    [AlunoController::class,'search'])
    ->name('aluno.search');

Route::get('aluno/report',
    [AlunoController::class,'report'])
    ->name('aluno.report');

Route::resource('aluno',
    AlunoController::class);

Route::post('curso/search',
    [CursoController::class,'search'])
    ->name('curso.search');
Route::resource('curso',
    CursoController::class);


Route::post('professor/search',
    [ProfessorController::class,'search'])
    ->name('professor.search');
Route::resource('professor',
ProfessorController::class);

Route::post('turma/search',
    [TurmaController::class,'search'])
    ->name('turma.search');
Route::resource('turma',
TurmaController::class);

