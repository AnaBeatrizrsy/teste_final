@extends('layouts.app')
@section('title', 'Cadastro de Turma')
@section('content')
    <h1>Cadastro de Turma</h1>

    <form action="{{ route("turma.store") }}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="">Descrição</label>
        <input type="text" name="descricao" id="descricao">
        <select name="curso_id" id="curso_id">
            <option value="">Selecione</option>
            @foreach ($cursos as $curso)
            <option value="{{$curso->id}}">{{$curso->nome}}</option>
            @endforeach
        </select>
       <p></p>
        <button type="submit">Salvar</button>
    </form>
@endsection