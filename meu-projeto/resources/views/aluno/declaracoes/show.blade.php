@extends('layouts.appAluno')

@section('title', 'Detalhes da Declaração')

@section('content')

<div class="d-flex justify-content-between align-items-center">
    <h1>Sobre a Declaração</h1>
    <a href="{{ route('aluno.declaracoes.index') }}" class="button">Voltar</a>
</div>

<table class="table table-white mt-3">
    <thead>
        <tr>
            <th>ID</th>
            <th>Comprovante</th>
            <th>Data</th>
            <th>PDF</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $declaracao->id }}</td>
            <td>{{ $declaracao->comprovante->atividade ?? '-' }}</td>
            <td>{{ $declaracao->data }}</td>
            <td>
                <a href="{{ route('aluno.declaracoes.pdf', $declaracao->id) }}" class="button button-delete material_symbols_outlined" target="_blank">download</a>
            </td>
        </tr>
    </tbody>
</table>

@endsection