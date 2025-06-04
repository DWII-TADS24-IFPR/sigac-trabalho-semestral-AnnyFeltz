@extends('layouts.app')

@section('title', 'SIGAC - Home')

@section('content')

<h1>HOME</h1>

<h3>Bem vindo!</h3>

<div class="botoes-principal">
    <div class="card-principal">
        <h4>Funções</h4>
        <a class="botao-principal button" href="{{ '/adm/solicitacoes' }}">Solicitações de Horas</a>
        <a class="botao-principal button" href="{{ '/relatorios/horas' }}">Gerar Graficos de Horas</a>
    </div>
    <div class="card-principal">
        <h4>Alunos</h4>
        <a class="button botao-principal" href="{{ route('alunos.index') }}">Index</a>
        <a class="button botao-principal" href="{{ route('alunos.create') }}">Create</a>
    </div>
    <div class="card-principal">
        <h4>Categorias</h4>
        <a class="button botao-principal" href="{{ route('categorias.index') }}">Index</a>
        <a class="button botao-principal" href="{{ route('categorias.create') }}">Create</a>
    </div>
    <div class="card-principal">
        <h4>Comprovantes</h4>
        <a class="button botao-principal" href="{{ route('comprovantes.index') }}">Index</a>
        <a class="button botao-principal" href="{{ route('comprovantes.create') }}">Create</a>
    </div>
    <div class="card-principal">
        <h4>Cursos</h4>
        <a class="button botao-principal" href="{{ route('cursos.index') }}">Index</a>
        <a class="button botao-principal" href="{{ route('cursos.create') }}">Create</a>
    </div>
    <div class="card-principal">
        <h4>Declarações</h4>
        <a class="button botao-principal" href="{{ route('declaracoes.index') }}">Index</a>
        <a class="button botao-principal" href="{{ route('declaracoes.create') }}">Create</a>
    </div>
    <div class="card-principal">
        <h4>Documentos</h4>
        <a class="button botao-principal" href="{{ route('documentos.index') }}">Index</a>
        <a class="button botao-principal" href="{{ route('documentos.create') }}">Create</a>
    </div>
    <div class="card-principal">
        <h4>Niveis</h4>
        <a class="button botao-principal" href="{{ route('nivels.index') }}">Index</a>
        <a class="button botao-principal" href="{{ route('nivels.create') }}">Create</a>
    </div>
    <div class="card-principal">
        <h4>Turmas</h4>
        <a class="button botao-principal" href="{{ route('turmas.index') }}">Index</a>
        <a class="button botao-principal" href="{{ route('turmas.create') }}">Create</a>
    </div>
</div>

@endsection