@extends('layouts.app')
@section('title', 'Lista de Professores')
@section('content')
    <h1>Lista de professor</h1>

    <table class="table table-striped">
        <thead>
            <tr>
              
                <th>Nome</th>
                <th>Disciplina</th>
                <th>Opções</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($professor as $professor)
            <tr>
                    <td>{{ $professor->nome }}</td>
                    <td>{{ $professor->disciplina }}</td>
                    <td>
                        <div class="grid text-center">
                        <a class="btn btn-success" href="{{ route('professor.edit', $professor->id) }}">Editar</a>
                        <a class="btn btn-primary" href="{{ route('professor.show', $professor->id) }}">Visualizar</a>
                        
                        <form action="{{ route('professor.destroy', $professor->id) }}" method="post">
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
    <a class="btn btn-secondary" href="{{ route('professor.create') }}">Adicionar Professor</a>  
@endsection