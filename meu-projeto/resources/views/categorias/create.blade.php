@extends('layouts.app')

@section('title', 'Criar Categoria')

@section('content')

<div class="d-flex justify-content-between align-items-center">
    <h1>Criar Nova Categoria</h1>
    <a href="{{ route('categorias.index') }}" class="button">Voltar</a>
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

<form action="{{ route('categorias.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome') }}" required>
    </div>

    <div class="mb-3">
        <label for="max_horas" class="form-label">Max Horas</label>
        <input type="number" class="form-control" id="max_horas" name="max_horas" value="{{ old('max_horas') }}" required>
    </div>

    <div class="mb-3">
        <label for="curso_id" class="form-label">Curso</label>
        <select class="form-select" id="curso_id" name="curso_id" required>
            <option value="" disabled selected>Selecione um curso</option>
            @foreach($cursos as $curso)
                <option value="{{ $curso->id }}" {{ old('curso_id') == $curso->id ? 'selected' : '' }}>{{ $curso->nome }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="button">Salvar</button>
</form>

@endsection
