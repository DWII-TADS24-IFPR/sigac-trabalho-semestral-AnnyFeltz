@extends('layouts.app')

@section('title', 'Turmas')

@section('content')

<h1>TURMAS</h1>

<a href="{{ route('turmas.create') }}" class="button">Add Turma</a>

<table class="table table-white mt-3">
    <thead>
        <tr>
            <th>ID</th>
            <th>ANO</th>
            <th>CURSO_ID</th>
            <th class="d-flex justify-content-end gap-1">AÇÕES</th>
        </tr>
    </thead>
    <tbody>
        @foreach($turmas as $turma)
        <tr>
            <td>{{ $turma->id }}</td>
            <td>{{ $turma->ano }}</td>
            <td>{{ $turma->curso_id }}</td>
            <td class="d-flex justify-content-end gap-1">
                <a href="{{ route('turmas.show', $turma->id) }}" class="button button-show material-symbols-outlined">visibility</a>
                <a href="{{ route('turmas.edit', $turma->id) }}" class="button button-edit material-symbols-outlined">edit</a>
                <form action="{{ route('turmas.destroy', $turma->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este item?');">
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