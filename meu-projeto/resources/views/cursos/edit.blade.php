@extends('layouts.app')

@section('title', 'Editar Nível')

@section('content')
<div class="d-flex justify-content-between align-items-center">
    <h1>Editar Nível</h1>
    <a href="{{ route('nivels.index') }}" class="button">Voltar</a>
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

<form action="{{ route('cursos.update', $curso->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <div class="mb_3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome', $curso->nome) }}" required>
        </div>

        <div class="mb_3">
            <label for="sigla" class="form-label">Sigla</label>
            <input type="text" class="form-control" id="sigla" name="sigla" value="{{ old('sigla', $curso->sigla) }}" required>
        </div>

        <div class="mb_3">
            <label for="total_horas" class="form-label">Total de Horas</label>
            <input type="number" class="form-control" id="total_horas" name="total_horas" value="{{ old('total_horas', $curso->total_horas) }}" required>
        </div>

        <div class="mb_3">
            <label for="nivel_id" class="form-label">Nível</label>
            <select class="form-select" id="nivel_id" name="nivel_id" required>
                <option value="">Selecione um nível</option>
                @foreach($nivels as $nivel)
                <option value="{{ $nivel->id }}" {{ $curso->nivel_id == $nivel->id ? 'selected' : '' }}>{{ $nivel->nome }}</option>
                @endforeach
            </select>
        </div>


    </div>

    <button type="submit" class="button">Salvar</button>
</form>
@endsection