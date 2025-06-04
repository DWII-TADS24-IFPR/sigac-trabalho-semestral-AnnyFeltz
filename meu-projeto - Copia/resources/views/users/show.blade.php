@extends('layouts.app')

@section('title', 'Show Usuário')

@section('content')

<div class="d-flex justify-content-between align-items-center">
    <h1>Sobre o usuário</h1>
    <a href="{{ route('users.index') }}" class="button">Voltar</a>
</div>

<table class="table table-white mt-3">
    <tr>
        <th>ID</th>
        <th>NOME</th>
        <th>EMAIL</th>
        <th>PERFIL</th>
    </tr>
    <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->nome }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->role->nome ?? '—' }}</td>
    </tr>
</table>

@endsection
