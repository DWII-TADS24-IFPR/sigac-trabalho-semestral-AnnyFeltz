@extends('layouts.app')

@section('title', 'Editar Usuário')

@section('content')

<div class="d-flex justify-content-between align-items-center">
    <h1>Editar Usuário</h1>
    <a href="{{ route('users.index') }}" class="button">Voltar</a>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome', $user->nome) }}" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Senha</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Deixe vazio para manter">
    </div>

    <div class="mb-3">
        <label for="senha_confirmation" class="form-label">Confirmar Senha</label>
        <input type="password" class="form-control" id="senha_confirmation" name="senha_confirmation" placeholder="Confirme a nova senha">
    </div>

    <div class="mb-3">
        <label for="role_id" class="form-label">Perfil</label>
        <select name="role_id" class="form-select" required>
            @foreach($roles as $role)
            <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                {{ $role->nome }}
            </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="button">Salvar</button>
</form>

@endsection
