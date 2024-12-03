@extends('base')
@section('titulo', 'Listagem Cursoss')
@section('conteudo')

    <h3>Listagem de Cursos</h3>
    <div class="row mb-4">
        <form action="{{ route('curso.search') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-3">
                    <select name="tipo" class="form-select">
                        <option value="nome">Nome</option>
                        <option value="requisito">Requisito</option>
                        <option value="carga_horaria">Carga Horária</option>
                        <option value="valor">Valor</option>
                    </select>
                </div>
                <div class="col-5">
                    <input type="text" name="valor" class="form-control">
                </div>
                <div class="col-4">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                    <a class="btn btn-success" href="{{ url('curso/create') }}">Novo</a>
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
                    <th scope="col">Requisito</th>
                    <th scope="col">Carga Horária</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Ação</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dados as $item)

                    <tr>
                        <td scope="row">{{$item->id}}</td>
                        <td>{{ $item->nome }}</td>
                        <td>{{ $item->requisito }}</td>
                        <td>{{ $item->carga_horaria }}</td>
                        <td>{{ $item->valor }}</td>
                        <td><a href="{{ route('curso.edit', $item->id) }}">Editar</a></td>
                        <td>
                            <form action=" {{ route('curso.destroy', $item->id) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <button type="submit" onclick="return confirm('Deseja remover o registro?')">
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
