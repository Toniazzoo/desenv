<?php


namespace App\Http\Controllers;


use App\Models\CategoriaFormacao;
use App\Models\Quarto;
use Illuminate\Http\Request;


class QuartoController extends Controller
{
    function index()
    {
        //select * from
        $dados = Quarto::All();


        return view('Quarto.list', [
            'dados' => $dados
        ]);
    }


    function create()
    {
        $categorias = CategoriaFormacao::All();


        return view('Quarto.form',[
            'categoria'=> $categorias,
        ]);
    }


    function store(Request $request)
    {


        $request->validate(
            [
                'nome' => 'required|max:150|min:3',
            ],
            [
                'nome.required' => " O :attribute é obrigatório",
                'nome.max' => " O máximo de caracteres para :attribute é 130",
                'nome.min' => " O mínimo de caracteres para :attribute é 3",
                ]
        );


        $data = $request->all();
        $imagem = $request->file('imagem');


        if($imagem){
            $nome_arquivo=
            date('YmdHis').".".$imagem->getClientOriginalExtension();
            $diretorio = "imagem/Quarto/";


            $imagem->storeAs($diretorio,
                $nome_arquivo,'public');


            $data['imagem'] = $diretorio.$nome_arquivo;
        }




        Quarto::create($data);


        return redirect('Quarto');
    }


    function edit($id)
    {
        $dado = Quarto::find($id);




        return view('Quarto.form', [
            'dado' => $dado,
        ]);
    }


    function update(Request $request, $id)
    {


        $request->validate(
            [
                'nome' => 'required|max:150|min:3',
            ],
            [
                'nome.required' => " O :attribute é obrigatório",
                'nome.max' => " O máximo de caracteres para :attribute é 130",
                'nome.min' => " O mínimo de caracteres para :attribute é 3",
                ]
        );


        $data = $request->all();


        Quarto::updateOrCreate(
            ['id' => $id],
            $data
        );


        return redirect('Quarto');
    }


    public function destroy($id)
    {
        $Quarto = Quarto::findOrFail($id);


        $Quarto->delete();


        return redirect('Quarto');
    }


    public function search(Request $request)
    {
        if (!empty($request->valor)) {
            $dados = Quarto::where(
                $request->tipo,
                'like',
                "%$request->valor%"


            )->get();
        } else {
            $dados = Quarto::All();
        }
        return view('Quarto.list', ['dados' => $dados]);
    }
}
