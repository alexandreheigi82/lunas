@extends('master')

@section('content')

<div class="min-h-screen flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold text-center mb-4 text-[#6cb3c3]">Editar Usuário</h2>

        @if (session()->has('message'))
        <div class="bg-green-500 text-white p-4 mb-4 rounded">
            {{ session()->get('message') }}
        </div>
        @endif

        <form action="{{ route('users.update', ['user' => $user->id]) }}" method="post">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <div class="mb-4">
                <input type="text" name="nome" value="{{ $user->nome }}" required class="w-full p-2 rounded bg-[#f1f1f1] text-[#26535e] focus:border-[#6cb3c3] focus:ring-2 focus:ring-[#6cb3c3] border-none">
            </div>
            <div class="mb-4">
                <input type="text" name="sobrenome" value="{{ $user->sobrenome }}" required class="w-full p-2 rounded bg-[#f1f1f1] text-[#26535e] focus:border-[#6cb3c3] focus:ring-2 focus:ring-[#6cb3c3] border-none">
            </div>
            <div class="mb-4">
                <input type="email" name="email" value="{{ $user->email }}" required class="w-full p-2 rounded bg-[#f1f1f1] text-[#26535e] focus:border-[#6cb3c3] focus:ring-2 focus:ring-[#6cb3c3] border-none">
            </div>
            <div class="mb-4">
                <input type="password" name="senha" placeholder="Nova Senha (opcional)" class="w-full p-2 rounded bg-[#f1f1f1] text-[#26535e] focus:border-[#6cb3c3] focus:ring-2 focus:ring-[#6cb3c3] border-none">
            </div>
            <div class="mb-4 flex items-center">
                <label class="mr-2 text-[#26535e]">Ativo:</label>
                <input type="checkbox" name="situacao" value="1" {{ $user->situacao ? 'checked' : '' }} class="bg-[#f1f1f1] text-[#6cb3c3] focus:ring-[#6cb3c3] border-none">
            </div>
            <div class="flex justify-between">
                <button type="submit" class="bg-[#6cb3c3] text-white font-bold py-2 px-4 rounded hover:bg-[#547cac] focus:outline-none focus:ring-2 focus:ring-[#547cac]">Atualizar</button>
                <button type="button" onclick="window.location.href='{{ route('users.index') }}'" class="bg-gray-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-gray-400">Cancelar</button>
            </div>
        </form>
    </div>
</div>

@endsection