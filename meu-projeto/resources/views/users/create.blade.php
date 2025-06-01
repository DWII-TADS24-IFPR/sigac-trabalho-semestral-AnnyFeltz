@extends('layouts.app')

@section('title', 'Criar Usuário')

@section('content')

<div class="d-flex justify-content-between align-items-center">
    <h1>Criar Novo Usuário</h1>
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

@include('components.sucess')

<form action="{{ route('users.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" class="form-control" id="nome" name="nome" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Senha</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>

    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirmar Senha</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
    </div>

    <div class="mb-3">
        <label for="role_id" class="form-label">Perfil</label>
        <select name="role_id" class="form-select" required>
            <option value="" selected disabled>Selecione um perfil</option>
            @foreach($roles as $role)
            <option value="{{ $role->id }}">{{ $role->nome }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="button">Salvar</button>
</form>

@endsection
