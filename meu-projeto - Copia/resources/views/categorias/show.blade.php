@extends('layouts.app')

@section('title', 'Show Categoria')

@section('content')

<div class="d-flex justify-content-between align-items-center">
    <h1>Sobre a Categoria</h1>
    <a href="{{ route('categorias.index') }}" class="button">Voltar</a>
</div>

<table class="table table-white mt-3">
    <thead>
        <tr>
            <th>ID</th>
            <th>NOME</th>
            <th>MAX HORAS</th>
            <th>CURSO</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $categoria->id }}</td>
            <td>{{ $categoria->nome }}</td>
            <td>{{ $categoria->max_horas }}</td>
            <td>{{ $categoria->curso->nome ?? '-' }}</td>
        </tr>
    </tbody>
</table>

@endsection
