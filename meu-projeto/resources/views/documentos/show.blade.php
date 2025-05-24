@extends('layouts.app')

@section('title', 'Show Documento')

@section('content')

<div class="d-flex justify-content-between align-items-center">
    <h1>Sobre o Documento</h1>
    <a href="{{ route('documentos.index') }}" class="button">Voltar</a>
</div>

<table class="table table-white mt-3">
    <thead>
        <tr>
            <th>ID</th>
            <th>DESCRIÇÃO</th>
            <th>STATUS</th>
            <th>URL</th>
            <th>CATEGORIA</th>
            <th>HORAS IN</th>
            <th>HORAS OUT</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $documento->id }}</td>
            <td>{{ $documento->descricao }}</td>
            <td>{{ $documento->status }}</td>
            <td><a href="{{ $documento->url }}" target="_blank">{{ $documento->url }}</a></td>
            <td>{{ $documento->categoria->nome ?? '-' }}</td>
            <td>{{ $documento->horas_in }}</td>
            <td>{{ $documento->horas_out }}</td>
        </tr>
    </tbody>

</table>

@endsection