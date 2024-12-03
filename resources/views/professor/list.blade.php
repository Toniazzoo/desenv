@extends('base')
@section('titulo', 'Listagem Professor')
@section('conteudo')

    <h3>Listagem de Professor</h3>
    <div class="row mb-4">
        <form action="{{ route('professor.search') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-3">
                    <select name="tipo" class="form-select">
                        <option value="nome">Nome</option>
                        <option value="email">E-mail</option>
                        <option value="tirulacao">Titulação</option>
                        <option value="formacao">Formação</option>
                    </select>
                </div>
                <div class="col-5">
                    <input type="text" name="valor" class="form-control">
                </div>
                <div class="col-4">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                    <a class="btn btn-success" href="{{ url('professor/create') }}">Novo</a>
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
                    <th scope="col">E-mail</th>
                    <th scope="col">Titulação</th>
                    <th scope="col">Formação</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Deletar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dados as $item)

                    <tr>
                        <td scope="row">{{$item->id}}</td>
                        <td>{{ $item->nome }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->titulacao }}</td>
                        <td>{{ $item->formacao }}</td>
                        <td><a class="btn btn-warning" href="{{ route('professor.edit', $item->id) }}">Editar</a></td>
                        <td>
                            <form action=" {{ route('professor.destroy', $item->id) }}" method="post">
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
