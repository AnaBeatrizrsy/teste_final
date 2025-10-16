@extends('layouts.app')
@section('title', 'Dados do Curso')
@section('content')
    <h1>Dados do Curso</h1>
    <p>Matricula:{{ $curso->nome }}</p>
@endsection