@extends('layouts.app')

@section('title', 'Create Nivel')

@section('content')

<div class="d-flex justify-content-between align-items-center">
    <h1>CRIAR NOVO NIVEL</h1>
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

<form action="{{ route('nivels.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" class="form-control" id="nome" name="nome" required>
    </div>

    <button type="submit" class="button">Salvar</button>

</form>

@endsection