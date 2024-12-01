@extends('master')

@section('content')
<div class="min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-4xl">
        <h2 class="text-3xl font-semibold text-center mb-6 text-[#6cb3c3]">Editar Venda #{{ $sale->id }}</h2>

        @if ($errors->any())
        <div class="bg-red-500 text-white p-4 mb-4 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('sales.update', $sale->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="client_id" class="block mb-2">Cliente:</label>
                <select name="client_id" id="client_id" required class="w-full p-2 rounded bg-gray-6cb3c3  text-6cb3c3">
                    @foreach ($clients as $client)
                    <option value="{{ $client->id }}" {{ $client->id == $sale->client_id ? 'selected' : '' }}>
                        {{ $client->nome }} {{ $client->sobrenome }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="package_id" class="block mb-2">Pacote de Turismo:</label>
                <select name="package_id" id="package_id" required class="w-full p-2 rounded bg-gray-6cb3c3  text-6cb3c3">
                    @foreach ($packages as $package)
                    <option value="{{ $package->id }}" data-valor="{{ $package->valor }}" data-descricao="{{ $package->descricao }}" data-vagas="{{ $package->vagas }}" {{ $package->id == $sale->package_id ? 'selected' : '' }}>
                        {{ $package->titulo }} - R$ {{ $package->valor }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="quantidade" class="block mb-2">Quantidade:</label>
                <input type="number" name="quantidade" id="quantidade" min="1" value="{{ $sale->quantidade }}" required class="w-full p-2 rounded bg-gray-6cb3c3  text-6cb3c3">
            </div>
            <div class="mb-4">
                <label for="vagas" class="block mb-2">Vagas Disponíveis:</label>
                <input type="text" id="vagas" readonly class="w-full p-2 rounded bg-gray-100 text-[#26535e] border border-gray-300">
            </div>
            <div class="mb-4">
                <label for="valor_total" class="block mb-2 text-[#26535e]">Valor Total:</label>
                <input type="text" id="valor_total" name="valor_total" readonly class="w-full p-2 rounded bg-gray-100 text-[#26535e] border border-gray-300" value="{{ $sale->valor_total }}">
            </div>
            <div class="flex justify-between">
                <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-400">Salvar</button>
                <button type="button" onclick="window.location.href='{{ route('sales.show', $sale->id) }}'" class="bg-gray-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-gray-400">Cancelar</button>
            </div>
        </form>
    </div>
</div>

<script>
    function atualizarValorTotal() {
        const packageSelect = document.getElementById('package_id');
        const selectedOption = packageSelect.options[packageSelect.selectedIndex];
        const valor = parseFloat(selectedOption.getAttribute('data-valor'));
        const quantidade = parseInt(document.getElementById('quantidade').value);
        const valorTotal = valor * quantidade;

        document.getElementById('valor_total').value = valorTotal.toFixed(2);
    }

    document.getElementById('package_id').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const vagas = selectedOption.getAttribute('data-vagas');
        document.getElementById('vagas').value = vagas;
        atualizarValorTotal();
    });

    document.getElementById('quantidade').addEventListener('input', function() {
        atualizarValorTotal();
    });

    // Exibe as vagas disponíveis e atualiza o valor total para o pacote selecionado inicialmente
    const initialSelectedOption = document.getElementById('package_id').selectedOptions[0];
    document.getElementById('vagas').value = initialSelectedOption.getAttribute('data-vagas');
    atualizarValorTotal();
</script>
@endsection
