@extends('master')

@section('content')
<div class="min-h-screen flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold text-center mb-4 text-[#6cb3c3]">Detalhes do Usuário</h2>

        @if (session()->has('message'))
        <div class="bg-green-500 text-white p-4 mb-4 rounded">
            {{ session()->get('message') }}
        </div>
        @endif

        <div class="mb-4">
            <p><strong>Nome:</strong> {{ $user->nome }}</p>
            <p><strong>Sobrenome:</strong> {{ $user->sobrenome }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Ativo:</strong> {{ $user->situacao ? 'Sim' : 'Não' }}</p>
        </div>

        <div class="flex justify-between mb-4">
            <a href="{{ route('users.index') }}" class="bg-gray-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-gray-400">Voltar</a>
            <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="bg-yellow-500 text-white py-2 px-4 rounded hover:bg-yellow-400">Editar</a>
            <button type="button" 
                    data-action="{{ route('users.destroy', ['user' => $user->id]) }}" 
                    class="openModal bg-red-500 text-white py-2 px-4 rounded hover:bg-red-400">
                Excluir
            </button>
        </div>
    </div>
</div>

<!-- Modal de Confirmação -->
<div id="confirmModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">
        <h3 class="text-lg font-semibold text-[#26535e] mb-4">Tem certeza que deseja excluir este usuário?</h3>
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
