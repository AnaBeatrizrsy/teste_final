@extends('layouts.app')
@section('title', 'Editar Professor')
@section('content')
    <h1>Editar Professor</h1>

    <form action="{{ route('contato_professor.update', $professor->professor_id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ $professor->nome }}" required>
        </div>
        <div class="mb-3">
            <label for="disciplina" class="form-label">Disciplina</label>
            <input type="text" class="form-control" id="disciplina" name="disciplina" value="{{ $professor->disciplina }}" required>
        </div>
        <button type="submit" class="btn btn-warning">Atualizar</button>
        <a href="{{ route('contato_professor.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection