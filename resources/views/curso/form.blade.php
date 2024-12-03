@extends('base')
@section('titulo', 'Formulário Curso')
@section('conteudo')
    <h3>Formulário Curso</h3>

    @php
        if (!empty($dado->id)) {
            $route = route('curso.update', $dado->id);
        } else {
            $route = route('curso.store');
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
                <label class="form-label">Raquisito</label><br>
                <input type="text" name="requisito" class="form-control"
                    value="@if (!empty($dado->requisito)) {{ $dado->requisito }}
                @elseif (!empty(old('requisito'))){{ old('requisito') }}
                @else{{ '' }} @endif"><br>
            </div>

            <div class="col-6">
                <label class="form-label">Carga Horária</label><br>
                <input type="text" name="carga_horaria" class="form-control"
                    value="@if (!empty($dado->carga_horaria)) {{ $dado->carga_horaria }}
                @elseif (!empty(old('carga_horaria'))){{ old('carga_horaria') }}
                @else{{ '' }} @endif"><br>
            </div>


            <div class="col-6">
                <label class="form-label">Valor</label><br>
                <input type="text" name="valor" class="form-control"
                    value="@if (!empty($dado->valor)) {{ $dado->valor }}
                @elseif (!empty(old('valor'))){{ old('valor') }}
                @else{{ '' }} @endif"><br>
            </div>

            <div class="col-6">
                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="{{ url('curso') }}" class="btn btn-light">Voltar</a></button>
            </div>
        </form>

    </div>

@stop
