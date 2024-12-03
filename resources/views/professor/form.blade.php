@extends('base')
@section('titulo', 'Formulário Professor')
@section('conteudo')
    <h3>Formulário Professor</h3>

    @php
        if (!empty($dado->id)) {
            $route = route('professor.update', $dado->id);
        } else {
            $route = route('professor.store');
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
                <label class="form-label">E-mail</label><br>
                <input type="text" name="email" class="form-control"
                    value="@if (!empty($dado->email)) {{ $dado->email }}
                @elseif (!empty(old('email'))){{ old('email') }}
                @else{{ '' }} @endif"><br>
            </div>

            <div class="col-6">
                <label class="form-label">Titulação</label><br>
                <input type="text" name="titulacao" class="form-control"
                    value="@if (!empty($dado->titulacao)) {{ $dado->titulacao }}
                @elseif (!empty(old('titulacao'))){{ old('titulacao') }}
                @else{{ '' }} @endif"><br>
            </div>


            <div class="col-6">
                <label class="form-label">Formação</label><br>
                <input type="text" name="formacao" class="form-control"
                    value="@if (!empty($dado->formacao)) {{ $dado->formacao }}
                @elseif (!empty(old('formacao'))){{ old('formacao') }}
                @else{{ '' }} @endif"><br>
            </div>

            <div class="col-6">
                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="{{ url('professor') }}" class="btn btn-light">Voltar</a></button>
            </div>
        </form>

    </div>

@stop
