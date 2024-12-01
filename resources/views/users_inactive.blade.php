@extends('master')

@section('content')

<div class="min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-4xl">

        <!-- Título Usuários Inativos -->
        <h2 class="text-3xl font-semibold text-center mb-6 text-[#6cb3c3]">Usuários Inativos</h2>

        <!-- Lista de Usuários -->
        <ul class="space-y-6">
            <!-- Botão de Voltar -->
            @foreach ($users as $user)
            <li class="bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition-all">
                <div class="flex flex-wrap justify-between items-center">
                    <span class="font-semibold text-[#26535e] text-xl">{{ $user->nome }}</span>
                    <div class="space-x-4 text-center md:text-right">
                        <a href="{{ route('users.show', ['user' => $user->id]) }}" class="bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-400 focus:outline-none focus:ring-2 focus:ring-green-400">Visualizar</a>
                        <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="bg-yellow-500 text-white py-2 px-4 rounded-lg hover:bg-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400">Editar</a>
                        <form action="{{ route('users.reactivate', ['user' => $user->id]) }}" method="post" class="inline">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-400">Ativar<button>

                        </form>
                        
                    </div>

                </div>
                
            </li>
            @endforeach
        </ul>
            <!-- Botões de ação -->
    <div class="flex justify-between mt-6">
        <div class="text-center mb-6">
            <a href="{{ route('users.index') }}" class="bg-gray-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-gray-400">Voltar</a>
        </div>
    </div>

    </div>
    

</div


    @endsection