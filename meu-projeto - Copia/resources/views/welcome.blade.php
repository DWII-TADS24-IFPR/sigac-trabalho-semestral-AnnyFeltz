@extends('layouts.guest')

@section('title', 'Welcome')

@section('content')
<h1> Olá, bem vindo(a) ao SIGAC </h1>

<div>
    <h3>aproveite o site, faça login se ja tiver uma conta ou se registre 😀</h3>
    <br>
    <a class="button botao" href="{{ '/login' }}">Login</a>
    <a class="button botao" href="{{ '/register' }}">Register</a>
</div>
@endsection