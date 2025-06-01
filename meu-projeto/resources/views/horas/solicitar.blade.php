@extends('layouts.app')

@section('title', 'Solicitar Horas Complementares')

@section('content')
<div class="d-flex justify-content-between align-items-center">
    <h1>Solicitar Horas Complementares</h1>
    <a href="{{ route('solicitacoes.index') }}" class="button">Voltar</a>
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

<form action="{{ route('solicitacoes.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="descricao" class="form-label">Descrição da Atividade</label>
        <input type="text" class="form-control" id="descricao" name="descricao" value="{{ old('descricao') }}" required>
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
        <label for="arquivo" class="form-label">Comprovante (PDF, imagem)</label>
        <input type="file" class="form-control" id="arquivo" name="arquivo" required>
    </div>

    <div class="mb-3">
        <label for="horas" class="form-label">Horas</label>
        <input type="number" step="0.5" min="0.5" class="form-control" id="horas" name="horas" value="{{ old('horas') }}" required>
    </div>

    <button type="submit" class="button">Enviar Solicitação</button>
</form>
@endsection
