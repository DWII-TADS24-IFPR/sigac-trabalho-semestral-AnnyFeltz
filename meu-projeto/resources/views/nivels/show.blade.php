@extends('layouts.app')

@section('title', 'Show Nivel')

@section('content')

<div class="d-flex justify-content-between align-items-center">
    <h1>Sobre o nivel</h1>
    <a href="{{ route('nivels.index') }}" class="button">Voltar</a>
</div>

<table class="table table-white mt-3">
    <tr>
        <th>ID</th>
        <th>NOME</th>
        <th>CURSOS</th>
    </tr>
    <tr>
        <td>{{ $nivel->id }}</td>
        <td>{{ $nivel->nome }}</td>
        <td>
            @foreach($nivel->cursos as $curso)
            {{ $curso->nome }}<br>
            @endforeach
        </td>
    </tr>
</table>

@endsection