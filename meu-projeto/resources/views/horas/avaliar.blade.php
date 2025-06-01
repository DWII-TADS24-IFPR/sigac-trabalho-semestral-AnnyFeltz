@extends('layouts.app')

@section('title', 'Avaliar Solicitação de Horas')

@section('content')
<div class="d-flex justify-content-between align-items-center">
    <h1>Avaliar Solicitação de Horas</h1>
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

<form action="{{ route('solicitacoes.avaliar', $solicitacao->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select class="form-select" id="status" name="status" required>
            <option value="pendente" {{ old('status', $solicitacao->status) == 'pendente' ? 'selected' : '' }}>Pendente</option>
            <option value="aprovado" {{ old('status', $solicitacao->status) == 'aprovado' ? 'selected' : '' }}>Aprovado</option>
            <option value="reprovado" {{ old('status', $solicitacao->status) == 'reprovado' ? 'selected' : '' }}>Reprovado</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="comentario" class="form-label">Comentário (opcional)</label>
        <textarea class="form-control" id="comentario" name="comentario" rows="3">{{ old('comentario', $solicitacao->comentario) }}</textarea>
    </div>

    <button type="submit" class="button">Salvar Avaliação</button>
</form>
@endsection
