<?php

namespace App\Http\Controllers;

use App\Models\CategoriaFormacao;
use App\Models\Professor;
use App\Models\Curso;
use App\Models\Turma;
use Illuminate\Http\Request;

class TurmaController extends Controller
{
    function index()
    {
        //select * from
        $dados = Turma::All();

        return view('turma.list', [
            'dados' => $dados
        ]);
    }

    function create()
    {
        $professores = Professor::All();
        $cursos = Curso::All();

        return view('turma.form',[
            'professores'=> $professores,
            'cursos'=> $cursos,
        ]);
    }

    function store(Request $request)
    {

        $request->validate(
            [
                'nome' => 'required|max:120|min:3',
                'professor_id' => 'required',
                'curso_id' => 'required',
            ],
            [
                'nome.required' => " O :attribute é obrigatório",
                'nome.max' => " O máximo de caracteres para :attribute é 150",
                'nome.min' => " O mínimo de caracteres para :attribute é 3",
                'professor_id.riquired' => " O :attribute é obrigatório",
                'curso_id.riquired' => " O :attribute é obrigatório",
                ]
        );

        $data = $request->all();
        $imagem = $request->file('imagem');

        if($imagem){
            $nome_arquivo=
            date('YmdHis').".".$imagem->getClientOriginalExtension();
            $diretorio = "imagem/turma/";

            $imagem->storeAs($diretorio,
                $nome_arquivo,'public');

            $data['imagem'] = $diretorio.$nome_arquivo;
        }


        Turma::create($data);

        return redirect('turma');
    }

    function edit($id)
    {
        $dado = Turma::find($id);


        return view('turma.form', [
            'dado' => $dado,
        ]);
    }

    function update(Request $request, $id)
    {

        $request->validate(
            [
                'nome' => 'required|max:120|min:3',
            ],
            [
                'nome.required' => " O :attribute é obrigatório",
                'nome.max' => " O máximo de caracteres para :attribute é 120",
                'nome.min' => " O mínimo de caracteres para :attribute é 3",
                ]
        );

        $data = $request->all();

        Turma::updateOrCreate(
            ['id' => $id],
            $data
        );

        return redirect('turma');
    }

    public function destroy($id)
    {
        $turma = Turma::findOrFail($id);

        $turma->delete();

        return redirect('turma');
    }

    public function search(Request $request)
    {
        if (!empty($request->valor)) {
            $dados = Turma::where(
                $request->tipo,
                'like',
                "%$request->valor%"

            )->get();
        } else {
            $dados = Turma::All();
        }
        return view('turma.list', ['dados' => $dados]);
    }
}
