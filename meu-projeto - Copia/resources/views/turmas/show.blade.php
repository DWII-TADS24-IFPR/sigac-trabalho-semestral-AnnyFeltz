@extends('layouts.app')

@section('title', 'Show Turma')

@section('content')

<div class="d-flex justify-content-between align-items-center">
    <h1>Sobre a Turma</h1>
    <a href="{{ route('turmas.index') }}" class="button">Voltar</a>
</div>

<table class="table table-white mt-3">
    <tr>
        <th>ID</th>
        <th>ANO</th>
        <th>CURSO</th>
    </tr>
    <tr>
        <td>{{ $turma->id }}</td>
        <td>{{ $turma->ano }}</td>
        <td>
            {{ $turma->curso->nome ?? 'Curso não encontrado' }}
        </td>

    </tr>
</table>

@endsection