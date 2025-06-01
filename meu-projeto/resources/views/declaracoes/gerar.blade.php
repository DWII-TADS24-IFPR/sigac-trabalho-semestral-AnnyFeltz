@extends('layouts.app')

@section('title', 'Gerar Declaração de Cumprimento')

@section('content')
<div class="d-flex justify-content-between align-items-center">
    <h1>Gerar Declaração de Cumprimento</h1>
    <a href="{{ route('declaracoes.index') }}" class="button">Voltar</a>
</div>

<form action="{{ route('declaracoes.gerar') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="aluno_id" class="form-label">Aluno</label>
        <select class="form-select" id="aluno_id" name="aluno_id" required>
            <option value="" disabled selected>Selecione o aluno</option>
            @foreach($alunos as $aluno)
            <option value="{{ $aluno->id }}" {{ old('aluno_id') == $aluno->id ? 'selected' : '' }}>{{ $aluno->nome }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="periodo" class="form-label">Período</label>
        <input type="text" class="form-control" id="periodo" name="periodo" placeholder="Ex: Jan 2024 - Dez 2024" value="{{ old('periodo') }}" required>
    </div>

    <button type="submit" class="button">Gerar Declaração</button>
</form>
@endsection
