@extends('layouts.app')
@section('title', 'Cadastro de Professor')
@section('content')
    <h1>Cadastro de Professor</h1>

    <form action="{{ route("professor.store") }}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="">Nome</label>
        <input type="text" name="nome" id="nome">
        <label for="">Disciplina</label>
        <input type="text" name="disciplina" id="disciplina">
        <p></p>
         <input type="file" name="foto" id="foto"><p></p>
        <button type="submit">Salvar</button>
    </form>
@endsection