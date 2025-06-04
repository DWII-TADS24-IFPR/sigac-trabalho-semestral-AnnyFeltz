@extends('layouts.app')

@section('title', 'Cursos')

@section('content')

<h1>CURSOS</h1>

<a href="{{ route('cursos.create') }}" class="button">Add Curso</a>

<table class="table table-white mt-3">
    <thead>
        <tr>
            <th>ID</th>
            <th>NOME</th>
            <th>NIVEL_ID</th>
            <th class="d-flex justify-content-end gap-1">AÇÕES</th>
        </tr>
    </thead>
    <tbody>
        @foreach($cursos as $curso)
        <tr>
            <td>{{ $curso->id }}</td>
            <td>{{ $curso->nome }}</td>
            <td>{{ $curso->nivel_id }}</td>
            <td class="d-flex justify-content-end gap-1">
                <a href="{{ route('cursos.show', $curso->id) }}" class="button button-show material-symbols-outlined">visibility</a>
                <a href="{{ route('cursos.edit', $curso->id) }}" class="button button-edit material-symbols-outlined">edit</a>
                <form action="{{ route('cursos.destroy', $curso->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este item?');">
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