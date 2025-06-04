@extends('layouts.appAluno')

@section('title', 'Criar Declaração')

@section('content')

<div class="d-flex justify-content-between align-items-center">
    <h1>Criar Nova Declaração</h1>
    <a href="{{ route('aluno.declaracoes.index') }}" class="button">Voltar</a>
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

<form action="{{ route('aluno.declaracoes.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="hash" class="form-label">Hash</label>
        <input type="text" class="form-control" id="hash" name="hash" value="{{ old('hash') }}" required>
    </div>

    <div class="mb-3">
        <label for="comprovante_id" class="form-label">Comprovante</label>
        <select class="form-select" id="comprovante_id" name="comprovante_id" required>
            <option value="" disabled selected>Selecione um comprovante</option>
            @foreach($comprovantes as $comprovante)
                <option value="{{ $comprovante->id }}" {{ old('comprovante_id') == $comprovante->id ? 'selected' : '' }}>{{ $comprovante->atividade }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="data" class="form-label">Data</label>
        <input type="date" class="form-control" id="data" name="data" value="{{ old('data') }}" required>
    </div>

    <button type="submit" class="button">Salvar</button>
</form>

@endsection
