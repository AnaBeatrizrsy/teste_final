@extends('layouts.app')
@section('title', 'Dados do Aluno')
@section('content')
    <h1>Dados do Aluno</h1>
    <p>Matricula:{{ $aluno->matricula }}</p>
    <p>Nome: {{ $aluno->nome }}</p>
    <p>Email: {{ $aluno->email }}</p>
    <p>Data de Nascimento: {{ $aluno->data_nascimento }}</p>
    <img src="{{asset($aluno->foto)}}" alt=""  style="max-width: 400px">
@endsection