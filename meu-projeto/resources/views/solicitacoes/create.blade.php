@extends('layouts.appAluno')

@section('title', 'Nova Solicitação')

@section('content')
<h1>Nova Solicitação</h1>

<form action="{{ route('solicitacoes.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="nome" class="form-label">Nome da Atividade</label>
        <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome') }}" required>
        @error('nome') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
        <label for="carga_horaria" class="form-label">Carga Horária (horas)</label>
        <input type="number" name="carga_horaria" id="carga_horaria" class="form-control" value="{{ old('carga_horaria') }}" required>
        @error('carga_horaria') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
        <label for="comprovante" class="form-label">Comprovante (pdf, jpg, png)</label>
        <input type="file" name="comprovante" id="comprovante" class="form-control" required>
        @error('comprovante') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <button type="submit" class="btn btn-success">Enviar Solicitação</button>
</form>
@endsection
