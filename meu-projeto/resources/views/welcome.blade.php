@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    <h1> Olá, bem vindo(a) ao SIGAC </h1>

    <h3>aproveite o site, faça login se ja tiver uma conta ou se registre 😀</h3>
    <br>
    <div class="display-flex justify-center gap-4 w-full h-full">
            <a class="button botao" href="{{ '/login' }}">Login</a>
            <a class="button botao" href="{{ '/register' }}">Register</a>
    </div>

@endsection