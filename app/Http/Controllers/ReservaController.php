<?php


namespace App\Http\Controllers;


use App\Models\CategoriaFormacao;
use App\Models\Professor;
use App\Models\Quarto;
use App\Models\Reserva;
use Illuminate\Http\Request;


class ReservaController extends Controller
{
    function index()
    {
        //select * from
        $dados = Reserva::All();


        return view('Reserva.list', [
            'dados' => $dados
        ]);
    }


    function create()
    {
        $professores = Professor::All();
        $cursos = Quarto::All();


        return view('Reserva.form',[
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
            $diretorio = "imagem/Reserva/";


            $imagem->storeAs($diretorio,
                $nome_arquivo,'public');


            $data['imagem'] = $diretorio.$nome_arquivo;
        }




        return redirect('Reserva');
    }


    function edit($id)
    {
        $dado = Reserva::find($id);




        return view('Reserva.form', [
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


        Reserva::updateOrCreate(
            ['id' => $id],
            $data
        );


        return redirect('Reserva');
    }


    public function destroy($id)
    {
        $Reserva = Reserva::findOrFail($id);


        $Reserva->delete();


        return redirect('Reserva');
    }


    public function search(Request $request)
    {
        if (!empty($request->valor)) {
            $dados = Reserva::where(
                $request->tipo,
                'like',
                "%$request->valor%"


            )->get();
        } else {
            $dados = Reserva::All();
        }
        return view('Reserva.list', ['dados' => $dados]);
    }
}
