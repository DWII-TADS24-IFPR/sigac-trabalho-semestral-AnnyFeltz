@extends('layouts.app')

@section('title', 'Show Curso')

@section('content')

<div class="d-flex justify-content-between align-items-center">
    <h1>Sobre o Curso</h1>
    <a href="{{ route('cursos.index') }}" class="button">Voltar</a>
</div>

<table class="table table-white mt-3">
    <tr>
        <th>ID</th>
        <th>NOME</th>
        <th>SIGLA</th>
        <th>TOTAL HORAS</th>
        <th>NIVEL</th>
    </tr>
    <tr>
        <td>{{ $curso->id }}</td>
        <td>{{ $curso->nome }}</td>
        <td>{{ $curso->sigla }}</td>
        <td>{{ $curso->total_horas }}</td>
        <td>
            {{ $curso->nivel->nome ?? 'Nivel não encontrado' }}
        </td>
        <td>
            @foreach($curso->turmas as $turma)
            {{ $turma->ano }}<br>
            @endforeach
        </td>
    </tr>
</table>

@endsection