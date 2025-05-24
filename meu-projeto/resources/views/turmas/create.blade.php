@extends('layouts.app')

@section('title', 'Create Turma')

@section('content')

<div class="d-flex justify-content-between align-items-center">
    <h1>CRIAR NOVA TURMA</h1>
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

<form action="{{ route('turmas.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <div class="mb_3">
            <label for="ano" class="form-label">Ano</label>
            <input type="text" class="form-control" id="ano" name="ano" value="{{ old('ano') }}" required>
        </div>

        <div class="mb_3">
            <label for="curso_id" class="form-label">Curso</label>
            <select class="form-select" id="curso_id" name="curso_id" required>
                <option value="">Selecione um curso</option>
                @foreach($cursos as $curso)
                <option value="{{ $curso->id }}">{{ $curso->nome }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <button type="submit" class="button">Salvar</button>

</form>

@endsection