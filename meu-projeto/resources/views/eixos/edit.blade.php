@extends('layouts.app')

@section('title', 'Editar Eixo')

@section('content')
<div class="d-flex justify-content-between align-items-center">
    <h1>Editar Eixo</h1>
    <a href="{{ route('eixos.index') }}" class="button">Voltar</a>
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

<form action="{{ route('eixos.update', $eixo->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome', $eixo->nome) }}" required>
        @error('nome')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="button">Salvar</button>
</form>
@endsection
