@extends('layouts.app')
@section('title', 'Detalhes do Professor')
@section('content')
    <h1>Detalhes do Professor</h1>

    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $professor->professor_id }}</p>
            <p><strong>Nome:</strong> {{ $professor->nome }}</p>
            <p><strong>Disciplina:</strong> {{ $professor->disciplina }}</p>
            <p><strong>Cadastrado em:</strong> {{ $professor->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Atualizado em:</strong> {{ $professor->updated_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <br>
    <a href="{{ route('contato_professor.index') }}" class="btn btn-secondary">Voltar</a>
@endsection