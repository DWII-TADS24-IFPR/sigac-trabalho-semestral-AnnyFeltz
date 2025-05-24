@extends('layouts.app')

@section('title', 'Create Curso')

@section('content')

<div class="d-flex justify-content-between align-items-center">
    <h1>CRIAR NOVO CURSO</h1>
    <a href="{{ route('cursos.index') }}" class="button">Voltar</a>
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

<form action="{{ route('cursos.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>

        <div class="mb-3"><label for="sigla" class="form-label">Sigla</label>
            <input type="text" class="form-control" id="sigla" name="sigla" required>
        </div>

        <div class="mb-3"><label for="total_horas" class="form-label">Total de Horas</label>
            <input type="number" step="0.01" class="form-control" id="total_horas" name="total_horas" required>
        </div>

        <div class="mb-3">
            <label for="nivel_id" class="form-label">Nível</label>
            <select class="form-select" id="nivel_id" name="nivel_id" required>
                <option value="">Selecione um nível</option>
                @foreach($nivels as $nivel)
                <option value="{{ $nivel->id }}">{{ $nivel->nome }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <button type="submit" class="button">Salvar</button>

</form>

@endsection