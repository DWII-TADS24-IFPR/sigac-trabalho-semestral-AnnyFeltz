@extends('layouts.appAluno')

@section('title', 'Solicitações')

@section('content')
<h1>Minhas Solicitações</h1>

<a href="{{ route('solicitacoes.create') }}" class="btn btn-primary mb-3">Nova Solicitação</a>

<table class="table">
    <thead>
        <tr>
            <th>Atividade</th>
            <th>Carga Horária</th>
            <th>Status</th>
            <th>Data</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($solicitacoes as $solicitacao)
            <tr>
                <td>{{ $solicitacao->nome }}</td>
                <td>{{ $solicitacao->carga_horaria }} h</td>
                <td>
                    @if($solicitacao->status == 'pendente')
                        <span class="badge bg-warning">Pendente</span>
                    @elseif($solicitacao->status == 'aprovado')
                        <span class="badge bg-success">Aprovado</span>
                    @else
                        <span class="badge bg-danger">Rejeitado</span>
                    @endif
                </td>
                <td>{{ $solicitacao->created_at->format('d/m/Y') }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5">Nenhuma solicitação feita ainda.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
