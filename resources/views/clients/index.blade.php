@extends('master')

@section('content')
<div class="min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-4xl">
        <h2 class="text-3xl font-bold text-center mb-6 text-[#6cb3c3]">Lista de Clientes</h2>

        @if (session('success'))
        <div class="bg-green-500 text-white p-4 mb-4 rounded">
            {{ session('success') }}
        </div>
        @endif

        @if ($clients->isEmpty())
        <p class="text-center text-[#26535e]">Nenhum cliente cadastrado.</p>
        @else
        <ul class="space-y-4">
            @foreach ($clients as $client)
            <li class="bg-[#f1f1f1] p-6 rounded-lg shadow-lg">
                <strong class="text-xl text-[#26535e]">{{ $client->nome }} {{ $client->sobrenome }}</strong><br>
                <span>Email: {{ $client->email }}</span><br>
                <span>Telefone: {{ $client->telefone }}</span><br>
                <span>Cidade: {{ $client->cidade }}</span><br>
                <span>Estado: {{ $client->estado }}</span><br>

                @auth
                <div class="mt-4 flex justify-between">
                    <a href="{{ route('clients.edit', $client->id) }}" 
                       class="bg-yellow-500 text-white py-2 px-4 rounded-lg hover:bg-yellow-400">Editar</a>
                    <button type="button" 
                            data-action="{{ route('clients.destroy', $client->id) }}" 
                            class="openModal bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-400">
                        Excluir
                    </button>
                </div>
                @endauth
            </li>
            @endforeach
        </ul>
        @endif
        <div class="flex justify-between items-center mb-8 mt-6">
            <a href="{{ route('clients.create') }}" 
               class="bg-[#6cb3c3] text-white py-3 px-6 rounded-lg hover:bg-[#547cac] focus:outline-none focus:ring-2 focus:ring-[#547cac]">
               Cadastrar Novo Cliente
            </a>
            <a href="{{ route('dashboard') }}" 
               class="bg-gray-500 text-white py-3 px-6 rounded-lg hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400">
                Voltar
            </a>
        </div>
    </div>
</div>

<!-- Modal de Confirmação -->
<div id="confirmModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">
        <h3 class="text-lg font-semibold text-[#26535e] mb-4">Tem certeza que deseja excluir este cliente?</h3>
        <div class="flex justify-end space-x-4">
            <button id="cancelButton" class="bg-gray-500 text-white py-2 px-4 rounded-lg hover:bg-gray-400">
                Cancelar
            </button>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-400">
                    Excluir
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const modal = document.getElementById('confirmModal');
        const deleteForm = document.getElementById('deleteForm');
        const cancelButton = document.getElementById('cancelButton');
        const openButtons = document.querySelectorAll('.openModal');

        openButtons.forEach(button => {
            button.addEventListener('click', () => {
                const action = button.getAttribute('data-action');
                deleteForm.setAttribute('action', action);
                modal.classList.remove('hidden');
            });
        });

        cancelButton.addEventListener('click', () => {
            modal.classList.add('hidden');
        });
    });
</script>
@endsection
