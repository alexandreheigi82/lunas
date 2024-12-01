@extends('master')

@section('content')
<div class="min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-4xl">
        <h2 class="text-3xl font-bold text-center mb-6 text-[#6cb3c3]">Detalhes do Pacote</h2>

        @if ($package)
        <div class="mb-6">
            <h3 class="text-2xl font-bold mb-4 text-[#26535e]">{{ $package->titulo }}</h3>
            <p class="text-lg text-[#26535e] mb-4">{{ $package->descricao }}</p>
            <p class="text-lg text-[#26535e] mb-2"><strong>Valor:</strong> R$ {{ number_format($package->valor, 2, ',', '.') }}</p>
            <p class="text-lg text-[#26535e] mb-4"><strong>Vagas:</strong> {{ $package->vagas }}</p>
            
            @if ($package->imagem)
            <div class="mb-6 flex justify-center">
                <img src="{{ asset('storage/' . $package->imagem) }}" 
                     alt="{{ $package->titulo }}" 
                     class="w-96 h-auto rounded shadow-lg">
            </div>
            @endif
            
            <div class="text-center">
                <a href="{{ $package->link }}" target="_blank" class="text-lg text-[#6cb3c3] underline hover:text-[#547cac]">
                    Fale conosco
                </a>
            </div>
        </div>

        <div class="flex justify-center space-x-4">
            <a href="{{ route('dashboard') }}" 
               class="bg-gray-500 text-white font-bold py-3 px-6 rounded-lg hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400">
                Voltar
            </a>
            <a href="{{ route('packages.edit', ['package' => $package->id]) }}" 
               class="bg-yellow-500 text-white font-bold py-3 px-6 rounded-lg hover:bg-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                Editar
            </a>
            <button type="button" 
                    data-action="{{ route('packages.destroy', ['package' => $package->id]) }}" 
                    class="openModal bg-red-500 text-white font-bold py-3 px-6 rounded-lg hover:bg-red-400 focus:outline-none focus:ring-2 focus:ring-red-400">
                Excluir
            </button>
        </div>

        @else
        <div class="text-center">
            <p class="text-lg text-[#26535e] font-semibold">Pacote não encontrado ou foi removido.</p>
            <div class="mt-6">
                <a href="{{ route('packages.index') }}" 
                   class="bg-gray-500 text-white font-bold py-3 px-6 rounded-lg hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400">
                    Voltar para a lista de pacotes
                </a>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Modal de Confirmação -->
<div id="confirmModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">
        <h3 class="text-lg font-semibold text-[#26535e] mb-4">Tem certeza que deseja excluir este pacote?</h3>
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
