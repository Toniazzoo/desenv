<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\CategoriaFormacao;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Storage;

class AlunoController extends Controller
{
    function index()
    {
        //select * from
        $dados = Aluno::All();

        return view('aluno.list', [
            'dados' => $dados
        ]);
    }

    function create()
    {
        $categorias = CategoriaFormacao::All();

        return view('aluno.form',[
            'categorias'=> $categorias,
        ]);
    }

    function store(Request $request)
    {

        $request->validate(
            [
                'nome' => 'required|max:130|min:3',
                'cpf' => 'required|max:14',
                'telefone' => 'required|max:20',
                'categoria_id' => 'required',
                'imagem' => 'nullable|image|mimes:png,jpeg,jpg',
            ],
            [
                'nome.required' => " O :attribute é obrigatório",
                'nome.max' => " O máximo de caracteres para :attribute é 130",
                'nome.min' => " O mínimo de caracteres para :attribute é 3",
                'cpf.required' => " O :attribute é obrigatório",
                'cpf.max' => " O máximo de caracteres para :attribute é 14",
                'telefone.required' => " O :attribute é obrigatório",
                'telefone.max' => " O máximo de caracteres para :attribute é 20",
                'categoria_id.required' => " A categoria é obrigatório",
                'imagem.image'=>'Deve ser enviado uma imagem',
                'imagem.mimes'=>'A imagem deve ser da extesão PNG,JPEG ou JPG',
                ]
        );

        $data = $request->all();
        $imagem = $request->file('imagem');

        if($imagem){
            $nome_arquivo=
            date('YmdHis').".".$imagem->getClientOriginalExtension();
            $diretorio = "imagem/aluno/";

            $imagem->storeAs($diretorio,
                $nome_arquivo,'public');

            $data['imagem'] = $diretorio.$nome_arquivo;
        }


        Aluno::create($data);

        return redirect('aluno');
    }

    function edit($id)
    {
        $dado = Aluno::find($id);

        $categorias = CategoriaFormacao::All();

        return view('aluno.form', [
            'dado' => $dado,
            'categorias'=>$categorias,
        ]);
    }

    function update(Request $request, $id)
    {

        $request->validate(
            [
                'nome' => 'required|max:130|min:3',
                'cpf' => 'required|max:14',
                'telefone' => 'required|max:20',
                'categoria_id' => 'required',
                'imagem' => 'nullable|image|mimes:png,jpeg,jpg',
            ],
            [
                'nome.required' => " O :attribute é obrigatório",
                'nome.max' => " O máximo de caracteres para :attribute é 130",
                'nome.min' => " O mínimo de caracteres para :attribute é 3",
                'cpf.required' => " O :attribute é obrigatório",
                'cpf.max' => " O máximo de caracteres para :attribute é 14",
                'telefone.required' => " O :attribute é obrigatório",
                'telefone.max' => " O máximo de caracteres para :attribute é 20",
                'categoria_id.required' => " A categoria é obrigatório",
                'imagem.image'=>'Deve ser enviado uma imagem',
                'imagem.mimes'=>'A imagem deve ser da extesão PNG,JPEG ou JPG',
                ]
        );

        $data = $request->all();
        $imagem = $request->file('imagem');

        if($imagem){
            $nome_arquivo=
            date('YmdHis').".".$imagem->getClientOriginalExtension();
            $diretorio = "imagem/aluno/";

            $imagem->storeAs($diretorio,
                $nome_arquivo,'public');

            $data['imagem'] = $diretorio.$nome_arquivo;
        }

        Aluno::updateOrCreate(
            ['id' => $id],
            $data
        );

        return redirect('aluno');
    }

    public function destroy($id)
    {
        $aluno = Aluno::findOrFail($id);

        if($aluno->hasFile('imagem')){
            Storage::delete($aluno->imagem);
        }

        $aluno->delete();

        return redirect('aluno');
    }

    public function search(Request $request)
    {
        if (!empty($request->valor)) {
            $dados = Aluno::where(
                $request->tipo,
                'like',
                "%$request->valor%"

            )->get();
        } else {
            $dados = Aluno::All();
        }
        return view('aluno.list', ['dados' => $dados]);
    }


    public function report(){

        $alunos = Aluno::All();

        $data = ['titulo'=>"Relatório Listagem de Alunos", 'alunos' => $alunos,];

        $pdf = Pdf::loadView('aluno.report', $data);
        return $pdf->download('relatorio_aluno.pdf');
    }

}
