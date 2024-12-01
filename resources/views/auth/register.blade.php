@extends('master')

@section('content')
<div class="bg-black text-white min-h-screen p-6 flex items-center justify-center">
    <div class="bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold text-center mb-4 text-blue-400">Registrar</h2>

        @if (session()->has('message'))
        <div class="bg-green-500 text-white p-4 mb-4 rounded">
            {{ session()->get('message') }}
        </div>
        @endif

        <form action="{{ route('register') }}" method="post">
            @csrf
            <div class="mb-4">
                <input type="text" name="nome" placeholder="Nome" required class="w-full p-2 rounded bg-gray-700 text-black">
            </div>
            <div class="mb-4">
                <input type="text" name="sobrenome" placeholder="Sobrenome" required class="w-full p-2 rounded bg-gray-700 text-black">
            </div>
            <div class="mb-4">
                <input type="email" name="email" placeholder="E-mail" required class="w-full p-2 rounded bg-gray-700 text-black">
            </div>
            <div class="mb-4">
                <input type="password" name="senha" placeholder="Senha" required class="w-full p-2 rounded bg-gray-700 text-black">
            </div>
            <div class="mb-4">
                <input type="password" name="senha_confirmation" placeholder="Confirmar Senha" required class="w-full p-2 rounded bg-gray-700 text-black">
            </div>
            <div class="mb-4 flex items-center">
                <label class="mr-2">Ativo:</label>
                <input type="checkbox" name="situacao" value="1" checked class="bg-gray-700 text-blue-400">
            </div>
            <div class="flex justify-between">
                <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-400">Registrar</button>
                <button type="button" onclick="window.location.href='{{ route('dashboard') }}'" class="bg-gray-600 text-white font-bold py-2 px-4 rounded hover:bg-gray-500">Cancelar</button>
            </div>
        </form>
    </div>
</div>
@endsection
