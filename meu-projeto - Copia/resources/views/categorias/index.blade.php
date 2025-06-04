@extends('layouts.app')

@section('title', 'Categorias')

@section('content')

<h1>Categorias</h1>

<a href="{{ route('categorias.create') }}" class="button">Adicionar Categoria</a>

<table class="table table-white mt-3">
    <thead>
        <tr>
            <th>ID</th>
            <th>NOME</th>
            <th>CURSO_ID</th>
            <th class="d-flex justify-content-end gap-1">AÇÕES</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categorias as $categoria)
        <tr>
            <td>{{ $categoria->id }}</td>
            <td>{{ $categoria->nome }}</td>
            <td>{{ $categoria->curso->id}}</td>
            <td class="d-flex justify-content-end gap-1">
                <a href="{{ route('categorias.show', $categoria->id) }}" class="button button-show material-symbols-outlined">visibility</a>
                <a href="{{ route('categorias.edit', $categoria->id) }}" class="button button-edit material-symbols-outlined">edit</a>
                <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" onsubmit="return confirm('Tem certeza?')">
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
