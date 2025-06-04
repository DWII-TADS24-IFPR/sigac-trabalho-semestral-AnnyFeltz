@extends('layouts.app')

@section('content')
<h1>Solicitações para Aprovação</h1>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Aluno</th>
            <th>Atividade</th>
            <th>Carga Horária</th>
            <th>Comprovante</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($solicitacoes as $solicitacao)
            <tr>
                <td>{{ $solicitacao->aluno->id }}</td>
                <td>{{ $solicitacao->aluno->nome }}</td>
                <td>{{ $solicitacao->nome }}</td>
                <td>{{ $solicitacao->carga_horaria }} h</td>
                <td><a href="{{ asset('storage/' . $solicitacao->comprovante) }}" target="_blank">Ver Comprovante</a></td>
                <td>
                    @if($solicitacao->status == 'pendente')
                        <span class="badge bg-warning">Pendente</span>
                    @elseif($solicitacao->status == 'aprovado')
                        <span class="badge bg-success">Aprovado</span>
                    @else
                        <span class="badge bg-danger">Rejeitado</span>
                    @endif
                </td>
                <td>
                    @if($solicitacao->status == 'pendente')
                        <form action="{{ route('solicitacoes.avaliar', $solicitacao->id) }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="status" value="aprovado">
                            <button type="submit" class="btn btn-success btn-sm">Aprovar</button>
                        </form>

                        <form action="{{ route('solicitacoes.avaliar', $solicitacao->id) }}" method="POST" class="d-inline mt-1">
                            @csrf
                            <input type="hidden" name="status" value="rejeitado">
                            <button type="submit" class="btn btn-danger btn-sm">Rejeitar</button>
                        </form>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6">Nenhuma solicitação pendente.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
