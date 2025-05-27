@extends('layouts.app')

@section('title', 'Show Eixo')

@section('content')

<div class="d-flex justify-content-between align-items-center">
    <h1>Sobre o eixo</h1>
    <a href="{{ route('eixos.index') }}" class="button">Voltar</a>
</div>

<table class="table table-white mt-3">
    <tr>
        <th>ID</th>
        <th>NOME</th>
        <th>CURSOS</th>
        <th>TURMAS</th>
    </tr>
    <tr>
        <td>{{ $eixo->id }}</td>
        <td>{{ $eixo->nome }}</td>
        <td>
            @foreach($eixo->cursos as $curso)
                {{ $curso->nome }}<br>
            @endforeach
        </td>
        <td>
            @foreach($eixo->turmas as $turma)
                {{ $turma->ano }}<br>
            @endforeach
        </td>
    </tr>
</table>

@endsection