@extends('layouts.appAluno')

@section('title', 'Minhas Declarações')

@section('content')

<h1>Minhas Declarações</h1>

<a href="{{ route('aluno.declaracoes.create') }}" class="button">Adicionar Declaração</a>

<table class="table table-white mt-3">
    <thead>
        <tr>
            <th>ID</th>
            <th>Comprovante</th>
            <th>Data</th>
            <th class="d-flex justify-content-end gap-1">Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($declaracoes as $declaracao)
        <tr>
            <td>{{ $declaracao->id }}</td>
            <td>{{ $declaracao->comprovante->atividade ?? '-' }}</td>
            <td>{{ $declaracao->data }}</td>
            <td class="d-flex justify-content-end gap-1">
                <a href="{{ route('aluno.declaracoes.pdf', $declaracao->id) }}" class="btn btn-primary btn-sm" target="_blank">Gerar PDF</a>
                <a href="{{ route('aluno.declaracoes.show', $declaracao->id) }}" class="button button-show material-symbols-outlined">visibility</a>
                <a href="{{ route('aluno.declaracoes.edit', $declaracao->id) }}" class="button button-edit material-symbols-outlined">edit</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection