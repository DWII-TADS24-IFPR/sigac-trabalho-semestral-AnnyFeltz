@extends('layouts.appAluno')

@section('title', 'Minha Turma')

@section('content')
<h1>Minha Turma</h1>

<table class="tabela">
    <thead>
        <tr>
            <th>Turma (Ano)</th>
            <th>Curso</th>
            <th>Eixo</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $turma->ano }}</td>
            <td>{{ $turma->curso->nome }}</td>
            <td>{{ $turma->curso->eixo->nome }}</td>
        </tr>
    </tbody>
</table>

<h2>Colegas da Turma</h2>

<table class="tabela">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        @foreach($turma->alunos as $aluno)
            <tr>
                <td>{{ $aluno->nome }}</td>
                <td>{{ $aluno->user->email ?? 'Sem email' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
