@extends('layouts.app')

@section('title', 'Níveis')

@section('content')

<h1>Niveis</h1>

<a href="{{ route('nivels.create') }}" class="button">Add Nível</a>

<table class="table table-white mt-3">
    <thead>
        <tr>
            <th>ID</th>
            <th>NOME</th>
            <th class="d-flex justify-content-end gap-1">AÇÕES</th>
        </tr>
    </thead>
    <tbody>
        @foreach($nivels as $nivel)
        <tr>
            <td>{{ $nivel->id }}</td>
            <td>{{ $nivel->nome }}</td>
            <td class="d-flex justify-content-end gap-1">
                <a href="{{ route('nivels.show', $nivel->id) }}" class="button button-show material-symbols-outlined">visibility</a>
                <a href="{{ route('nivels.edit', $nivel->id) }}" class="button button-edit material-symbols-outlined">edit</a>
                <form action="{{ route('nivels.destroy', $nivel->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este item?');">
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