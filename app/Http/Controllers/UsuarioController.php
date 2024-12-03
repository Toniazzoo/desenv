<?php


namespace App\Http\Controllers;


use App\Models\Usuario;
use App\Models\CategoriaFormacao;
use Dompdf\Adapter\PDFLib;
use Illuminate\Http\Request;
use Storage;
use Barryvdh\DomPDF\Facade\Pdf;


class UsuarioController extends Controller
{
    function index()
    {
        //select * from
        $dados = Usuario::All();


        return view('Usuario.list', [
            'dados' => $dados
        ]);
    }


    function create()
    {
        $categorias = CategoriaFormacao::All();


        return view('Usuario.form',[
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
            $diretorio = "imagem/Usuario/";


            $imagem->storeAs($diretorio,
                $nome_arquivo,'public');


            $data['imagem'] = $diretorio.$nome_arquivo;
        }




        Usuario::create($data);


        return redirect('Usuario');
    }


    function edit($id)
    {
        $dado = Usuario::find($id);


        $categorias = CategoriaFormacao::All();


        return view('Usuario.form', [
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
            $diretorio = "imagem/Usuario/";


            $imagem->storeAs($diretorio,
                $nome_arquivo,'public');


            $data['imagem'] = $diretorio.$nome_arquivo;
        }


        Usuario::updateOrCreate(
            ['id' => $id],
            $data
        );


        return redirect('Usuario');
    }


    public function destroy($id)
    {
        $Usuario = Usuario::findOrFail($id);


        if($Usuario->hasFile('imagem')){
            Storage::delete($Usuario->imagem);
        }


        $Usuario->delete();


        return redirect('Usuario');
    }


    public function search(Request $request)
    {
        if (!empty($request->valor)) {
            $dados = Usuario::where(
                $request->tipo,
                'like',
                "%$request->valor%"


            )->get();
        } else {
            $dados = Usuario::All();
        }
        return view('Usuario.list', ['dados' => $dados]);
    }


    public function report(){


        $Usuarios = Usuario::All();




        $data = ['titulo' => "Relatório Listagem de Usuarios", 'Usuarios' => $Usuarios,];


        $pdf = Pdf::loadView('Usuario.report', $data);
        return $pdf->download('relatório_Usuario.pdf');
    }




}
