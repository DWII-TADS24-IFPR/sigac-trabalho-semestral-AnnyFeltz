@extends('layouts.app')

@section('title', 'Criar Aluno')

@section('content')

<div class="d-flex justify-content-between align-items-center">
    <h1>CRIAR NOVO ALUNO</h1>
    <a href="{{ route('alunos.index') }}" class="button">Voltar</a>
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

<form action="{{ route('alunos.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome') }}" required>
    </div>

    <div class="mb-3">
        <label for="cpf" class="form-label">CPF</label>
        <input type="text" class="form-control" id="cpf" name="cpf" value="{{ old('cpf') }}" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Senha</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>

    <div class="mb-3">
        <label for="curso_id" class="form-label">Curso</label>
        <select class="form-select" name="curso_id" required>
            <option value="" disabled selected>Selecione o curso</option>
            @foreach($cursos as $curso)
            <option value="{{ $curso->id }}" {{ old('curso_id') == $curso->id ? 'selected' : '' }}>
                {{ $curso->nome }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="turma_id" class="form-label">Turma</label>
        <select class="form-select" name="turma_id" required>
            <option value="" disabled selected>Selecione a turma</option>
            @foreach($turmas as $turma)
            <option value="{{ $turma->id }}" {{ old('turma_id') == $turma->id ? 'selected' : '' }}>
                {{ $turma->ano }}
            </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="button">Salvar</button>
</form>

@endsection
