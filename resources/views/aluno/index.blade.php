@extends('layouts.app')
@section('title', 'Lista de Alunos')
@section('content')
    <h1>Lista de aluno</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Data de Nascimento</th>
                <th>Opções</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($alunos as $aluno)
            <tr>
                    <td>{{ $aluno->matricula }}</td>
                    <td>{{ $aluno->nome }}</td>
                    <td>{{ $aluno->email }}</td>
                    <td>{{ $aluno->data_nascimento}}</td>
                    <td>
                        <div class="grid text-center">
                        <a class="btn btn-success" href="{{ route('aluno.edit', $aluno->id) }}">Editar</a>
                        <a class="btn btn-primary" href="{{ route('aluno.show', $aluno->id) }}">Visualizar</a>
                        
                        <form action="{{ route('aluno.destroy', $aluno->id) }}" method="post">
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
    <a class="btn btn-secondary" href="{{ route('aluno.create') }}">Adicionar novo aluno</a>  
@endsection 


