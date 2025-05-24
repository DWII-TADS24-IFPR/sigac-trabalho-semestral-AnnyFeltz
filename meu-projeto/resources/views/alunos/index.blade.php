@extends('layouts.app')

@section('title', 'Alunos')

@section('content')

<h1>Alunos</h1>

<a href="{{ route('alunos.create') }}" class="button">Add Aluno</a>

<table class="table table-white mt-3">
    <thead>
        <tr>
            <th>ID</th>
            <th>NOME</th>
            <th>CPF</th>
            <th>EMAIL</th>
            <th class="d-flex justify-content-end gap-1">AÇÕES</th>
        </tr>
    </thead>
    <tbody>
        @foreach($alunos as $aluno)
        <tr>
            <td>{{ $aluno->id }}</td>
            <td>{{ $aluno->nome }}</td>
            <td>{{ $aluno->cpf }}</td>
            <td>{{ $aluno->email }}</td>
            <td class="d-flex justify-content-end gap-1">
                <a href="{{ route('alunos.show', $aluno->id) }}" class="button button-show material-symbols-outlined">visibility</a>
                <a href="{{ route('alunos.edit', $aluno->id) }}" class="button button-edit material-symbols-outlined">edit</a>
                <form action="{{ route('alunos.destroy', $aluno->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este aluno?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="button button-delete material-symbols-outlined">delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
