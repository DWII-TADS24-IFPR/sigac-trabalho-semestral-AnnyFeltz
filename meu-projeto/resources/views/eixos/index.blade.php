@extends('layouts.app')

@section('title', 'Eixos')

@section('content')

<h1>Eixos</h1>

<a href="{{ route('eixos.create') }}" class="button">Add Eixo</a>

<table class="table table-white mt-3">
    <thead>
        <tr>
            <th>ID</th>
            <th>NOME</th>
            <th class="d-flex justify-content-end gap-1">AÇÕES</th>
        </tr>
    </thead>
    <tbody>
        @foreach($eixos as $eixo)
        <tr>
            <td>{{ $eixo->id }}</td>
            <td>{{ $eixo->nome }}</td>
            <td class="d-flex justify-content-end gap-1">
                <a href="{{ route('eixos.show', $eixo->id) }}" class="button button-show material-symbols-outlined">visibility</a>
                <a href="{{ route('eixos.edit', $eixo->id) }}" class="button button-edit material-symbols-outlined">edit</a>
                <form action="{{ route('eixos.destroy', $eixo->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este item?');">
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