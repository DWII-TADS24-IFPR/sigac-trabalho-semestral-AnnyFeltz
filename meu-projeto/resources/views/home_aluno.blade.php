@extends('layouts.app')

@section('title', 'SIGAC - Home')

@section('content')

<h1>HOME</h1>

<h3>Bem vindo!</h3>

<div class="botoes">
        <div class="card">
            <h4>Alunos</h4>
            <a class="button botao" href="{{ route('alunos.index') }}">Index</a>
            <a class="button botao" href="{{ route('alunos.create') }}">Create</a>
        </div>
        
    </div>

    @endsection