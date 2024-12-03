@extends('base')
@section('titulo', 'Listagem Turma')
@section('conteudo')

    <h3>Listagem de Turma</h3>
    <div class="row mb-4">
        <form action="{{ route('turma.search') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-3">
                    <select name="tipo" class="form-select">
                        <option value="nome">Nome</option>
                        <option value="professor-id">Professor</option>
                        <option value="curso_id">Curso</option>
                        <option value="codigo">Código</option>
                        <option value="data_inicio">Data Inicio</option>
                        <option value="data_fim">Data Fim</option>
                    </select>
                </div>
                <div class="col-5">
                    <input type="text" name="valor" class="form-control">
                </div>
                <div class="col-4">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                    <a class="btn btn-success" href="{{ url('turma/create') }}">Novo</a>
                </div>
            </div>
        </form>
    </div>
    <div class="row">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Professor</th>
                    <th scope="col">Curso</th>
                    <th scope="col">Código</th>
                    <th scope="col">Data Início</th>
                    <th scope="col">Data Fim</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Deletar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dados as $item)

                    <tr>
                        <td scope="row">{{$item->id}}</td>
                        <td>{{ $item->nome }}</td>
                        <td>{{ $item->professor_id }}</td>
                        <td>{{ $item->curso_id }}</td>
                        <td>{{ $item->codigo }}</td>
                        <td>{{ date('d/m/Y', strtotime($item->data_inicio)) ?""}}</td>
                        <td>{{ date('d/m/Y', strtotime($item->data_fim)) ?"" }}</td>
                        <td><a class="btn btn-warning" href="{{ route('turma.edit', $item->id) }}">Editar</a></td>
                        <td>
                            <form action=" {{ route('turma.destroy', $item->id) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Deseja remover o registro?')">
                                    Deletar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop
