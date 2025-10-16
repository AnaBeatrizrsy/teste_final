@extends('layouts.app')
@section('title', 'Lista de Professores')
@section('content')
    <h1>Lista de Professores</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Disciplina</th>
                <th>Opções</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($professores as $professor)
                <tr>
                    <td>{{ $professor->professor_id }}</td>
                    <td>{{ $professor->nome }}</td>
                    <td>{{ $professor->disciplina }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <a class="btn btn-warning" href="{{ route('contato_professor.edit', $professor->professor_id) }}">Editar</a>
                            <a class="btn btn-info" href="{{ route('contato_professor.show', $professor->professor_id) }}">Visualizar</a>
                            <form action="{{ route('contato_professor.destroy', $professor->professor_id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit" onclick="return confirm('Tem certeza que deseja excluir este professor?')">Excluir</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>
    <a class="btn btn-success" href="{{ route('contato_professor.create') }}">Adicionar Professor</a>
@endsection