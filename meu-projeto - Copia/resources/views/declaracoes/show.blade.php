@extends('layouts.app')

@section('title', 'Show Declaração')

@section('content')

<div class="d-flex justify-content-between align-items-center">
    <h1>Sobre a Declaração</h1>
    <a href="{{ route('declaracoes.index') }}" class="button">Voltar</a>
</div>

<table class="table table-white mt-3">
    <thead>
        <tr>
            <th>ID</th>
            <th>ALUNO</th>
            <th>COMPROVANTE</th>
            <th>DATA</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $declaracao->id }}</td>
            <td>{{ $declaracao->aluno->nome ?? '-' }}</td>
            <td>{{ $declaracao->comprovante->atividade ?? '-' }}</td>
            <td>{{ $declaracao->data }}</td>
        </tr>
    </tbody>
</table>

@endsection
