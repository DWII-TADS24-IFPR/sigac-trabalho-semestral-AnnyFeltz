@extends('layouts.app')

@section('title', 'Documentos')

@section('content')

<h1>Documentos</h1>

<a href="{{ route('documentos.create') }}" class="button">Adicionar Documento</a>

<table class="table table-white mt-3">
    <thead>
        <tr>
            <th>ID</th>
            <th>DESCRIÇÃO</th>
            <th>STATUS</th>
            <th>CATEGORIA_ID</th>
            <th class="d-flex justify-content-end gap-1">AÇÕES</th>
        </tr>
    </thead>
    <tbody>
        @foreach($documentos as $documento)
        <tr>
            <td>{{ $documento->id }}</td>
            <td>{{ $documento->descricao }}</td>
            <td>{{ $documento->status }}</td>
            <td>{{ $documento->categoria->id}}</td>
            <td class="d-flex justify-content-end gap-1">
                <a href="{{ route('documentos.show', $documento->id) }}" class="button button-show material-symbols-outlined">visibility</a>
                <a href="{{ route('documentos.edit', $documento->id) }}" class="button button-edit material-symbols-outlined">edit</a>
                <form action="{{ route('documentos.destroy', $documento->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este item?');">
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
