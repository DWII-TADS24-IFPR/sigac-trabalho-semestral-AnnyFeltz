@extends('layouts.app')

@section('title', 'Criar Comprovante')

@section('content')

<div class="d-flex justify-content-between align-items-center">
    <h1>Criar Novo Comprovante</h1>
    <a href="{{ route('comprovantes.index') }}" class="button">Voltar</a>
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

<form action="{{ route('comprovantes.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="atividade" class="form-label">Atividade</label>
        <input type="text" class="form-control" id="atividade" name="atividade" value="{{ old('atividade') }}" required>
    </div>

    <div class="mb-3">
        <label for="horas" class="form-label">Horas</label>
        <input type="number" class="form-control" id="horas" name="horas" value="{{ old('horas') }}" required>
    </div>

    <div class="mb-3">
        <label for="aluno_id" class="form-label">Aluno</label>
        <select class="form-select" id="aluno_id" name="aluno_id" required>
            <option value="" disabled selected>Selecione um aluno</option>
            @foreach($alunos as $aluno)
                <option value="{{ $aluno->id }}" {{ old('aluno_id') == $aluno->id ? 'selected' : '' }}>{{ $aluno->nome }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="categoria_id" class="form-label">Categoria</label>
        <select class="form-select" id="categoria_id" name="categoria_id" required>
            <option value="" disabled selected>Selecione uma categoria</option>
            @foreach($categorias as $categoria)
                <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>{{ $categoria->nome }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="button">Salvar</button>
</form>

@endsection
