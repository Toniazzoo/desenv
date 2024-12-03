@extends('base')
@section('titulo', 'Formulário Turma')
@section('conteudo')
    <h3>Formulário Turma</h3>

    @php
        if (!empty($dado->id)) {
            $route = route('turma.update', $dado->id);
        } else {
            $route = route('turma.store');
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
                <label class="form-label">Professor</label><br>
                <input type="text" name="professor_id" class="form-control"
                    value="@if (!empty($dado->professor_id)) {{ $dado->professor_id }}
                @elseif (!empty(old('professor_id'))){{ old('professor_id') }}
                @else{{ '' }} @endif"><br>
            </div>

            <div class="col-6">
                <label class="form-label">Curso</label><br>
                <input type="text" name="curso_id" class="form-control"
                    value="@if (!empty($dado->curso_id)) {{ $dado->curso_id }}
                @elseif (!empty(old('curso_id'))){{ old('curso_id') }}
                @else{{ '' }} @endif"><br>
            </div>


            <div class="col-6">
                <label class="form-label">Código</label><br>
                <input type="text" name="codigo" class="form-control"
                    value="@if (!empty($dado->codigo)) {{ $dado->codigo }}
                @elseif (!empty(old('codigo'))){{ old('codigo') }}
                @else{{ '' }} @endif"><br>
            </div>

            <div class="col-6">
                <label class="form-label">Data Início</label><br>
                <input type="text" name="data_incio" class="form-control"
                    value="@if (!empty($dado->data_incio)) {{ $dado->data_incio }}
                    @elseif (!empty(old('data_incio'))){{ old('data_incio') }}
                    @else{{ '' }} @endif"><br>
            </div>

            <div class="col-6">
                <label class="form-label">Data Fim</label><br>
                <input type="text" name="data_fim" class="form-control"
                    value="@if (!empty($dado->data_fim)) {{ $dado->data_fim }}
                    @elseif (!empty(old('data_fim'))){{ old('data_fim') }}
                    @else{{ '' }} @endif"><br>
            </div>

            <div class="col-6">
                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="{{ url('turma') }}" class="btn btn-light">Voltar</a></button>
            </div>
        </form>

    </div>

@stop
