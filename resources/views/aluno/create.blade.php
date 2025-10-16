@extends('layouts.app')
@section('title', 'Cadastro de Aluno')
@section('content')
    <h1>Cadastro de Aluno</h1>

    <form action="{{ route("aluno.store") }}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="">Matricula</label>
        <input type="text" name="matricula" id="matricula">
        <label for="">Nome</label>
        <input type="text" name="nome" id="nome">
        <label for="">Email</label>
        <input type="email" name="email" id="email">
        <label for="">Datas de Nascimento</label>
        <input type="date" name="data_nascimento" id="data_nascimento"><p></p>
        <label for="">Telefone</label>
        <input type="telefone" name="telefone" id="telefone">
         <input type="file" name="foto" id="foto">
            <select name="turma_id" id="turma_id">
                <option value="">Selecione</option>
                @foreach ($turmas as $turma)
                <option value="{{ $turma->id}}">{{ $turma->descricao}}</option>
                @endforeach
            </select>
            
         <p></p>

        <button type="submit">Salvar</button>
    </form>
@endsection