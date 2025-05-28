@extends('layouts.appAluno')

@section('title', 'SIGAC - Home')

@section('content')

<h1>HOME</h1>

<h3>Bem vindo!</h3>

<div class="botoes-principal">
    <div class="card-principal">
        <h4>Funções</h4>
        <br>
        <div class="botoes-lado-a-lado">
            <a class="botao-principal button" href="{{ '/declarar-horas' }}">Gerar Declaração de Cumprimento</a>
            <a class="botao-principal button" href="{{ '/solicitar-horas' }}">Solicitar Horas Complementares</a>
        </div>
    </div>
</div>

@endsection