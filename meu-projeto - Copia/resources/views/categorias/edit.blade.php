@extends('layouts.app')

@section('title', 'Editar Categoria')

@section('content')

<div class="d-flex justify-content-between align-items-center">
    <h1>Editar Categoria</h1>
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

<form action="{{ route('categorias.update', $categoria->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome', $categoria->nome) }}" required>
    </div>

    <div class="mb-3">
        <label for="max_horas" class="form-label">Max Horas</label>
        <input type="number" class="form-control" id="max_horas" name="max_horas" value="{{ old('max_horas', $categoria->max_horas) }}" required>
    </div>

    <div class="mb-3">
        <label for="curso_id" class="form-label">Curso</label>
        <select class="form-select" id="curso_id" name="curso_id" required>
            @foreach($cursos as $curso)
                <option value="{{ $curso->id }}" {{ old('curso_id', $categoria->curso_id) == $curso->id ? 'selected' : '' }}>{{ $curso->nome }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="button">Salvar</button>
</form>

@endsection
