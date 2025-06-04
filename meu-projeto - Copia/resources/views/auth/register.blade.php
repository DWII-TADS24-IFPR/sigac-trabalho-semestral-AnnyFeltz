@extends('layouts.app')

@section('content')

@if ($errors->any())
<div class="mb-4 text-sm text-red-600">
    <ul class="list-disc list-inside">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="login_register_form">

<h1>Registrar</h1>

    <form method=" POST" action="{{ route('register') }}">
        @csrf

        <div>
            <label for="name" class="block font-medium text-sm text-gray-700">Nome</label>
            <input id="name" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-500"
                type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
        </div>

        <div class="mt-4">
            <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
            <input id="email" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-500"
                type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
        </div>

        <div class="mt-4">
            <label for="password" class="block font-medium text-sm text-gray-700">Senha</label>
            <input id="password" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-500"
                type="password" name="password" required autocomplete="new-password">
        </div>

        <div class="mt-4">
            <label for="password_confirmation" class="block font-medium text-sm text-gray-700">Confirme a Senha</label>
            <input id="password_confirmation" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-500"
                type="password" name="password_confirmation" required autocomplete="new-password">
        </div>

        <div class="mt-4">
            <label for="role" class="block font-medium text-sm text-gray-700">Tipo de usuário</label>
            <select id="role" name="role" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-500" required>
                <option value="" disabled selected>Selecione o tipo</option>
                <option value="1" {{ old('role') == 1 ? 'selected' : '' }}>Admin</option>
                <option value="2" {{ old('role') == 2 ? 'selected' : '' }}>Aluno</option>
            </select>
        </div>

        <p>se for aluno preencher tambem esses</p>

        <div id="alunoFields" class="hidden mt-4">
            <label for="cpf" class="block font-medium text-sm text-gray-700">CPF</label>
            <input id="cpf" name="cpf" type="text" class="block mt-1 w-full ..." value="{{ old('cpf') }}">

            <label for="curso_id" class="block font-medium text-sm text-gray-700 mt-4">Curso</label>
            <select id="curso_id" name="curso_id" class="block mt-1 w-full ...">
                <option value="" disabled selected>Selecione o curso</option>
                @foreach($cursos as $curso)
                <option value="{{ $curso->id }}" {{ old('curso_id') == $curso->id ? 'selected' : '' }}>{{ $curso->nome }}</option>
                @endforeach
            </select>

            <label for="turma_id" class="block font-medium text-sm text-gray-700 mt-4">Turma</label>
            <select id="turma_id" name="turma_id" class="block mt-1 w-full ...">
                <option value="" disabled selected>Selecione a turma</option>
                @foreach($turmas as $turma)
                <option value="{{ $turma->id }}" {{ old('turma_id') == $turma->id ? 'selected' : '' }}>{{ $turma->ano }}</option>
                @endforeach
            </select>
        </div>

        <br>
        <div>
            <a class="underline text-sm text-gray-600 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                Já registrado?
            </a>


        </div>
        <br>
        <button type="submit" class="button botao">
            Registrar
        </button>
    </form>

</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const roleSelect = document.getElementById('role');
        const alunoFields = document.getElementById('alunoFields');

        function toggleAlunoFields() {
            const isAluno = roleSelect.value === '2';
            alunoFields.classList.toggle('hidden', !isAluno);
            alunoFields.querySelectorAll('input, select').forEach(el => {
                el.required = isAluno;
            });
        }

        roleSelect.addEventListener('change', toggleAlunoFields);
        toggleAlunoFields();
    });
</script>
@endpush

@endsection