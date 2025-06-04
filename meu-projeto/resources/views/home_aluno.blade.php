@extends('layouts.appAluno')

@section('title', 'SIGAC - Home')

@section('content')

<h1>HOME</h1>

<h3>Bem vindo!</h3>

<div class="botoes-principal">

    <div class="card-principal" style="margin-top: 20px;">
        <h4>Solicitações</h4>
        <a class="botao-principal button" href="{{ route('solicitacoes.index') }}">index</a>
        <a class="botao-principal button" href="{{ route('solicitacoes.create') }}">create</a>
    </div>

    <div class="card-principal" style="margin-top: 20px;">
        <h4>Declarações</h4>
        <a class="botao-principal button" href="{{ route('aluno.declaracoes.index') }}">index</a>
        <a class="botao-principal button" href="{{ route('aluno.declaracoes.create') }}">create</a>
    </div>

</div>

@endsection