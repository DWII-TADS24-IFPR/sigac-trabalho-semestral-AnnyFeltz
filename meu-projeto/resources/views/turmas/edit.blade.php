@extends('layouts.app')

@section('title', 'Editar Turma')

@section('content')
<div class="d-flex justify-content-between align-items-center">
    <h1>Editar Turma</h1>
    <a href="{{ route('turmas.index') }}" class="button">Voltar</a>
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

<form action="{{ route('turmas.update', $turma->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <div class="mb_3">
            <label for="ano" class="form-label">Ano</label>
            <input type="text" class="form-control" id="ano" name="ano" value="{{ old('ano', $turma->ano) }}" required>
        </div>

        <div class="mb_3">
            <label for="curso_id" class="form-label">Curso</label>
            <select class="form-select" id="curso_id" name="curso_id" required>
                <option value="">Selecione um curso</option>
                @foreach($cursos as $curso)
                <option value="{{ $curso->id }}" {{ $turma->curso_id == $curso->id ? 'selected' : '' }}>{{ $curso->nome }}</option>
                @endforeach
            </select>
        </div>        
    </div>

    <button type="submit" class="button">Salvar</button>
</form>
@endsection
