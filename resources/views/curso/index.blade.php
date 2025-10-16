@extends('layouts.app')
@section('title', 'Lista de Curso')
@section('content')
    <h1>Lista de curso</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Opções</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($curso as $curso)
            <tr>
                    <td>{{ $curso->nome }}</td>
                
                    <td>
                        <div class="grid text-center">
                        <a class="btn btn-success" href="{{ route('curso.edit', $curso->id) }}">Editar</a>
                        <a class="btn btn-primary" href="{{ route('curso.show', $curso->id) }}">Visualizar</a>
                        
                        <form action="{{ route('curso.destroy', $curso->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Excluir</button>
                          </div>  
                        </form>
                    </td>
            @endforeach
            </tr>
        </tbody>
    </table>
    <br>
    <a class="btn btn-secondary" href="{{ route('curso.create') }}">Adicionar Curso</a>  
@endsection