@extends('layouts.app')
@section('title', 'Lista de Turma')
@section('content')
    <h1>Lista de Turmas</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Descrição</th>
                <th>Curso</th> {{-- Adicionei esta coluna --}}
                <th>Opções</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($turmas as $turma)
                <tr>
                    <td>{{ $turma->descricao }}</td> {{-- Corrigido: descricao em vez de nome --}}
                    <td>{{ $turma->curso->nome ?? 'N/A' }}</td> {{-- Adicionei o nome do curso --}}
                    <td>
                        <div class="d-flex gap-2">
                            <a class="btn btn-warning" href="{{ route('turma.edit', $turma->id) }}">Editar</a> {{-- Mudei para warning --}}
                            <a class="btn btn-info" href="{{ route('turma.show', $turma->id) }}">Visualizar</a> {{-- Mudei para info --}}
                            <form action="{{ route('turma.destroy', $turma->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit" onclick="return confirm('Tem certeza que deseja excluir esta turma?')">Excluir</button> {{-- Adicionei confirmação --}}
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>
    <a class="btn btn-success" href="{{ route('turma.create') }}">Adicionar Turma</a> {{-- Mudei para success --}}
@endsection