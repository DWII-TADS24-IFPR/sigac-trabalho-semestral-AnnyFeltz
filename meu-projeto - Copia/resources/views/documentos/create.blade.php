@extends('layouts.app')

@section('title', 'Criar Documento')

@section('content')

<div class="d-flex justify-content-between align-items-center">
    <h1>Criar Novo Documento</h1>
    <a href="{{ route('documentos.index') }}" class="button">Voltar</a>
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

<form action="{{ route('documentos.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="descricao" class="form-label">Descrição</label>
        <input type="text" class="form-control" id="descricao" name="descricao" required>
    </div>

    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <input type="text" class="form-control" id="status" name="status" required>
    </div>

    <div class="mb-3">
        <label for="url" class="form-label">URL</label>
        <input type="url" class="form-control" id="url" name="url" value="{{ old('url') }}">
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

    <div class="mb-3">
        <label for="horas_in" class="form-label">Horas In</label>
        <input type="number" class="form-control" id="horas_in" name="horas_in" required>
    </div>

    <div class="mb-3">
        <label for="horas_out" class="form-label">Horas Out</label>
        <input type="number" class="form-control" id="horas_out" name="horas_out" required>
    </div>

    <button type="submit" class="button">Salvar</button>
</form>

@endsection