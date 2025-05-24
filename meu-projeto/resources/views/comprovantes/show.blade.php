@extends('layouts.app')

@section('title', 'Mostrar Comprovante')

@section('content')

<div class="d-flex justify-content-between align-items-center">
    <h1>Sobre o Comprovante</h1>
    <a href="{{ route('comprovantes.index') }}" class="button">Voltar</a>
</div>

<table class="table table-white mt-3">
    <thead>
        <tr>
            <th>ID</th>
            <th>ATIVIDADE</th>
            <th>HORAS</th>
            <th>ALUNO</th>
            <th>CATEGORIA</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $comprovante->id }}</td>
            <td>{{ $comprovante->atividade ?? '-' }}</td>
            <td>{{ $comprovante->horas ?? '-' }}</td>
            <td>{{ $comprovante->aluno->nome ?? '-' }}</td>
            <td>{{ $comprovante->categoria->nome ?? '-' }}</td>
        </tr>
    </tbody>
</table>

@endsection
