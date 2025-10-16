@extends('layouts.app')
@section('title', 'Editar Aluno')
@section('content')
    <h1>Editar Aluno</h1>

    <form action="{{ route('aluno.update', $aluno) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label for="">Matricula</label>
        <input type="text" name="matricula" id="matricula" value="{{ $aluno->matricula }}">
        <label for="">Nome</label>
        <input type="text" name="nome" id="nome" value="{{ $aluno->nome }}">
        <label for="">Email</label>
        <input type="email" name="email" id="email" value="{{ $aluno->email }}">
        <label for="">Datas de Nascimento</label>
        <input type="date" name="data_nascimento" id="data_nascimento" value="{{ $aluno->data_nascimento }}"><p></p>
        <label for="">Telefone</label>
        <input type="telefone" name="telefone" id="telefone" value="{{ $aluno->telefone}}">
        <input type="file" name="foto" id="foto"><p></p>
         <img src="{{asset($aluno->foto)}}" alt=""  style="max-width: 400px">
        <button type="submit">Salvar</button>
    </form>
@endsection