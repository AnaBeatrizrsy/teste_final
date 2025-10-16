@extends('layouts.app')
@section('title', 'Editar Curso')
@section('content')
    <h1>Editar Curso</h1>

    <form action="{{ route('curso.update', $curso) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label for="">Nome</label>
        <input type="text" name="nome" id="nome" value="{{ $curso->nome }}">
        <button type="submit">Salvar</button>
    </form>
@endsection
