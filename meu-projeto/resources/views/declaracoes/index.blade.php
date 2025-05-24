@extends('layouts.app')

@section('title', 'Declarações')

@section('content')

<h1>Declarações</h1>

<a href="{{ route('declaracoes.create') }}" class="button">Adicionar Declaração</a>

<table class="table table-white mt-3">
    <thead>
        <tr>
            <th>ID</th>
            <th>ALUNO</th>
            <th>COMPROVANTE_ID</th>
            <th class="d-flex justify-content-end gap-1">AÇÕES</th>
        </tr>
    </thead>
    <tbody>
        @foreach($declaracoes as $declaracao)
        <tr>
            <td>{{ $declaracao->id }}</td>
            <td>{{ $declaracao->aluno->nome ?? '-' }}</td>
            <td>{{ $declaracao->comprovante->id}}</td>
            <td class="d-flex justify-content-end gap-1">
                <a href="{{ route('declaracoes.show', $declaracao->id) }}" class="button button-show material-symbols-outlined">visibility</a>
                <a href="{{ route('declaracoes.edit', $declaracao->id) }}" class="button button-edit material-symbols-outlined">edit</a>
                <form action="{{ route('declaracoes.destroy', $declaracao->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este item?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="button button-delete material-symbols-outlined">delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
