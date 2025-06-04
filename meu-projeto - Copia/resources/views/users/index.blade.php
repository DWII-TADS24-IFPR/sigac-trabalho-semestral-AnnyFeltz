@extends('layouts.app')

@section('title', 'Usuários')

@section('content')

<h1>Usuários</h1>

<a href="{{ route('users.create') }}" class="button">Add Usuário</a>

<table class="table table-white mt-3">
    <thead>
        <tr>
            <th>ID</th>
            <th>NOME</th>
            <th>EMAIL</th>
            <th>PERFIL</th>
            <th class="d-flex justify-content-end gap-1">AÇÕES</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->nome }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role->nome ?? '—' }}</td>
            <td class="d-flex justify-content-end gap-1">
                <a href="{{ route('users.show', $user->id) }}" class="button button-show material-symbols-outlined">visibility</a>
                <a href="{{ route('users.edit', $user->id) }}" class="button button-edit material-symbols-outlined">edit</a>
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este usuário?');">
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
