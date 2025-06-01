@extends('layouts.appAluno')

@section('title', 'SIGAC - Home')

@section('content')

<h1>HOME</h1>

<h3>Bem vindo!</h3>

<div class="botoes-principal">

    <div class="card-principal" style="margin-top: 20px;">
        <h4>Declarações</h4>
        <a class="botao-principal button" href="/gerar-declaracao">Gerar Declaração de Cumprimento</a>
        <a class="botao-principal button" href="/declaracoes">Ver Declarações Geradas</a>
    </div>

    <div class="card-principal" style="margin-top: 20px;">
        <h4>Turma</h4>
        <a class="botao-principal button" href="/turmas/minha">Minha Turma</a>
        <a class="botao-principal button" href="/turmas/colegas">Colegas da Turma</a>
    </div>

    <div class="card-principal" style="margin-top: 20px;">
        <h4>Solicitações</h4>
        <a class="botao-principal button" href="/solicitar-horas">Solicitar Horas Complementares</a>
        <a class="botao-principal button" href="/solicitacoes/minhas">Minhas Solicitações Enviadas</a>
    </div>

</div>

@endsection