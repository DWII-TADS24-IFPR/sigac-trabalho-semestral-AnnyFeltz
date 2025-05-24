@extends('layouts.app')

@section('title', 'Show Aluno')

@section('content')

<div class="d-flex justify-content-between align-items-center">
    <h1>Sobre o aluno</h1>
    <a href="{{ route('alunos.index') }}" class="button">Voltar</a>
</div>

<table class="table table-white mt-3">
    <tr>
        <th>ID</th>
        <th>NOME</th>
        <th>CPF</th>
        <th>EMAIL</th>
        <th>CURSO</th>
        <th>TURMA</th>
    </tr>
    <tr>
        <td>{{ $aluno->id }}</td>
        <td>{{ $aluno->nome }}</td>
        <td>{{ $aluno->cpf }}</td>
        <td>{{ $aluno->email }}</td>
        <td>{{ $aluno->curso->nome ?? '—' }}</td>
        <td>{{ $aluno->turma->ano ?? '—' }}</td>
    </tr>
</table>

@endsection
