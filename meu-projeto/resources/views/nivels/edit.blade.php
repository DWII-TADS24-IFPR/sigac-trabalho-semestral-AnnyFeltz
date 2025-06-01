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

@include('components.sucess')

<form action="{{ route('nivels.update', $nivel->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome', $nivel->nome) }}" required>
        @error('nome')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="button">Salvar</button>
</form>
@endsection
