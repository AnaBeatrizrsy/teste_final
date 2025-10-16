@extends('layouts.app')
@section('title', 'Cadastro de Curso')
@section('content')
    <h1>Cadastro de Curso</h1>

    <form action="{{ route("curso.store") }}" method="post">
        @csrf
        <label for="">Nome</label>
        <input type="text" name="nome" id="nome">
        <p></p>
        <button type="submit">Salvar</button>
    </form>
@endsection