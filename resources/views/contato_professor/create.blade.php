@extends('layouts.app')
@section('title', 'Cadastrar Professor')
@section('content')
    <h1>Cadastrar Professor</h1>

    <form action="{{ route('contato_professor.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>
        <div class="mb-3">
            <label for="disciplina" class="form-label">Disciplina</label>
            <input type="text" class="form-control" id="disciplina" name="disciplina" required>
        </div>
        <button type="submit" class="btn btn-success">Cadastrar</button>
        <a href="{{ route('contato_professor.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection