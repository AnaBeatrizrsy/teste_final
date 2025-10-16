@extends('layouts.app')
@section('title', 'Dados do Professor')
@section('content')
    <h1>Dados do Professor</h1>
    <p>Nome:{{ $professor->nome }}</p>
    <p>Disciplina: {{ $professor->disciplina }}</p>
    <img src="{{asset($professor->foto)}}" alt=""  style="max-width: 400px">
@endsection