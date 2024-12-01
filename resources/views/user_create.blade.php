@extends('master')

@section('content')

<div class="min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-4xl">
        <h2 class="text-3xl font-bold text-center mb-6 text-[#6cb3c3]">Criar Novo Usuário</h2>

        @if (session()->has('message'))
        <div class="bg-green-500 text-white p-4 mb-4 rounded">
            {{ session()->get('message') }}
        </div>
        @endif

        <form action="{{ route('users.store') }}" method="post">
            @csrf
            <!-- Grid com duas colunas para desktop -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-4">
                    <input type="text" name="nome" placeholder="Nome" required class="w-full p-3 rounded-lg bg-[#f1f1f1] text-[#26535e] focus:border-[#6cb3c3] focus:ring-2 focus:ring-[#6cb3c3] border-none">
                </div>
                <div class="mb-4">
                    <input type="text" name="sobrenome" placeholder="Sobrenome" required class="w-full p-3 rounded-lg bg-[#f1f1f1] text-[#26535e] focus:border-[#6cb3c3] focus:ring-2 focus:ring-[#6cb3c3] border-none">
                </div>
            </div>

            <!-- Grid com duas colunas para email e senha -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-4">
                    <input type="email" name="email" placeholder="E-mail" required class="w-full p-3 rounded-lg bg-[#f1f1f1] text-[#26535e] focus:border-[#6cb3c3] focus:ring-2 focus:ring-[#6cb3c3] border-none">
                </div>
                <div class="mb-4">
                    <input type="password" name="senha" placeholder="Senha" required class="w-full p-3 rounded-lg bg-[#f1f1f1] text-[#26535e] focus:border-[#6cb3c3] focus:ring-2 focus:ring-[#6cb3c3] border-none">
                </div>
            </div>

            <!-- Opção de checkbox para "Ativo" -->
            <div class="mb-6 flex items-center">
                <label class="mr-3 text-[#26535e]">Ativo:</label>
                <input type="checkbox" name="situacao" value="1" checked class="text-[#6cb3c3] focus:ring-[#6cb3c3] border-none">
            </div>

            <!-- Botões de ação -->
            <div class="flex justify-between mt-6">
                <button type="submit" class="bg-[#6cb3c3] text-white font-bold py-3 px-6 rounded-lg hover:bg-[#547cac] focus:outline-none focus:ring-2 focus:ring-[#547cac]">Criar Novo</button>
                <button type="button" onclick="window.location.href='{{ route('users.index') }}'" class="bg-gray-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-gray-400">Cancelar</button>
            </div>
        </form>
    </div>
</div>

@endsection
