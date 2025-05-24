@extends('layouts.app')

@section('title', 'Comprovantes')

@section('content')

<h1>Comprovantes</h1>

<a href="{{ route('comprovantes.create') }}" class="button">Adicionar Comprovante</a>

<table class="table table-white mt-3">
    <thead>
        <tr>
            <th>ID</th>
            <th>ATIVIDADE</th>
            <th>ALUNO</th>
            <th class="d-flex justify-content-end gap-1">AÇÕES</th>
        </tr>
    </thead>
    <tbody>
        @foreach($comprovantes as $comprovante)
        <tr>
            <td>{{ $comprovante->id }}</td>
            <td>{{ $comprovante->atividade ?? '-' }}</td>
            <td>{{ $comprovante->aluno->nome ?? '-' }}</td>
            <td class="d-flex justify-content-end gap-1">
                <a href="{{ route('comprovantes.show', $comprovante->id) }}" class="button button-show material-symbols-outlined">visibility</a>
                <a href="{{ route('comprovantes.edit', $comprovante->id) }}" class="button button-edit material-symbols-outlined">edit</a>
                <form action="{{ route('comprovantes.destroy', $comprovante->id) }}" method="POST" onsubmit="return confirm('Tem certeza?')">
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
