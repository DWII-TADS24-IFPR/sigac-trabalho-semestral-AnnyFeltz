@extends('layouts.app')

@section('title', 'Editar Declaração')

@section('content')

<div class="d-flex justify-content-between align-items-center">
    <h1>Editar Declaração</h1>
    <a href="{{ route('declaracoes.index') }}" class="button">Voltar</a>
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

<form action="{{ route('declaracoes.update', $declaracao->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="aluno_id" class="form-label">Aluno</label>
        <select class="form-select" id="aluno_id" name="aluno_id" required>
            @foreach($alunos as $aluno)
                <option value="{{ $aluno->id }}" {{ old('aluno_id', $declaracao->aluno_id) == $aluno->id ? 'selected' : '' }}>{{ $aluno->nome }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="comprovante_id" class="form-label">Comprovante</label>
        <select class="form-select" id="comprovante_id" name="comprovante_id" required>
            @foreach($comprovantes as $comprovante)
                <option value="{{ $comprovante->id }}" {{ old('comprovante_id', $declaracao->comprovante_id) == $comprovante->id ? 'selected' : '' }}>{{ $comprovante->atividade }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="data" class="form-label">Data</label>
        <input type="date" class="form-control" id="data" name="data" value="{{ old('data', $declaracao->data) }}" required>
    </div>

    <button type="submit" class="button">Salvar</button>
</form>

@endsection
