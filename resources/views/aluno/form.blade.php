@extends('base')
@section('titulo', 'Formulário Aluno')
@section('conteudo')
    <h3>Formulário Aluno</h3>

    @php
        if (!empty($dado->id)) {
            $route = route('aluno.update', $dado->id);
        } else {
            $route = route('aluno.store');
        }
    @endphp

    <div class="row">

        <form action="{{ $route }}" method="post" enctype="multipart/form-data">
            <!-- csrf camada de segurança-->
            @csrf

            @if (!empty($dado->id))
                @method('put')
            @endif

            <input type="hidden" name="id"
                value="@if (!empty($dado->id)) {{ $dado->id }}
            @else{{ '' }} @endif">

            <div class="col-6">
                <label class="form-label">Nome</label><br>
                <input type="text" name="nome" class="form-control"
                    value="@if (!empty($dado->nome)) {{ $dado->nome }}
                    @elseif (!empty(old('nome'))){{ old('nome') }}
                    @else{{ '' }} @endif"><br>
            </div>

            <div class="col-6">
                <label class="form-label">CPF</label><br>
                <input type="text" name="cpf" class="form-control"
                    value="@if (!empty($dado->cpf)) {{ $dado->cpf }}
                @elseif (!empty(old('cpf'))){{ old('cpf') }}
                @else{{ '' }} @endif"><br>
            </div>

            <div class="col-6">
                <label class="form-label">Telefone</label><br>
                <input type="text" name="telefone" class="form-control"
                    value="@if (!empty($dado->telefone)) {{ $dado->telefone }}
                @elseif (!empty(old('telefone'))){{ old('telefone') }}
                @else{{ '' }} @endif"><br>
            </div>

            <div class="col-6">
                <label class="form-label">Categoria</label><br>
                <select name="categoria_id" class="form-select">
                    @foreach ($categorias as $categoria)
                        <option @if (!empty($dado->categoria_id) && $dado->categoria_id == $categoria->id) {{ 'selected' }} @endif value="{{ $categoria->id }}">
                            {{ $categoria->nome }}</option>
                    @endforeach
                </select><br>
            </div>

            @php
                $nome_imagem = !empty($dado->imagem) ? $dado->imagem : 'sem_imagem.jpg';
            @endphp

            <div class="col-6">
                <label class="form-label">Imagem</label><br>
                <img src="/storage/{{ $nome_imagem }}" width="200px" alt="imagem">
                <input type="file" name="imagem" class="form-control"
                    value="@if (!empty($dado->imagem)) {{ $dado->imagem }}
                @elseif(!empty(old('imagem'))){{ old('imagem') }}
                @else{{ '' }} @endif"><br>
            </div>

            <div class="col-6">
                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="{{ url('aluno') }}" class="btn btn-light">Voltar</a></button>
            </div>
        </form>

    </div>

@stop
