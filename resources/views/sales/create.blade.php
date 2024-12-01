@extends('master')

@section('content')
<div class="min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-4xl">
        <h2 class="text-2xl font-bold text-center mb-4 text-[#6cb3c3]">Efetuar Venda</h2>

        @if ($errors->any())
        <div class="bg-red-500 text-white p-4 mb-4 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if(session('client_not_found'))
        <div class="bg-yellow-500 text-white p-4 mb-4 rounded">
            {{ session('client_not_found') }}
        </div>
        <div class="mb-4 text-center">
            <a href="{{ route('clients.create') }}" class="bg-[#6cb3c3] text-white py-3 px-6 rounded-lg hover:bg-[#547cac] focus:outline-none focus:ring-2 focus:ring-[#547cac]">
                Cadastrar Novo Cliente
            </a>
        </div>
        @endif

        <form action="{{ route('sales.store') }}" method="POST">
            @csrf
            <div class="mb-4 relative">
                <label for="client_search" class="block mb-2 text-[#26535e]">Cliente:</label>
                <input type="text" id="client_search" name="client_search" placeholder="Digite o nome do cliente" required class="w-full p-2 rounded bg-gray-100 text-[#26535e] border border-gray-300 focus:ring-2 focus:ring-[#6cb3c3] focus:outline-none">
                <input type="hidden" id="client_id" name="client_id" value="{{ old('client_id') }}">
                <div id="client_list" class="absolute bg-black text-white border-gray-300 rounded mt-2 w-full z-10 hidden max-h-40 overflow-y-auto">
                    <!-- Resultados da busca serão exibidos aqui -->
                </div>
            </div>

            <div class="mb-4">
                <label for="package_id" class="block mb-2 text-[#26535e]">Pacote de Turismo:</label>
                <select name="package_id" id="package_id" required class="w-full p-2 rounded bg-gray-100 text-[#26535e] border border-gray-300 focus:ring-2 focus:ring-[#6cb3c3]">
                    @foreach ($packages as $package)
                    <option value="{{ $package->id }}" data-valor="{{ $package->valor }}" data-descricao="{{ $package->descricao }}" data-vagas="{{ $package->vagas }}">
                        {{ $package->titulo }} - R$ {{ $package->valor }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="quantidade" class="block mb-2 text-[#26535e]">Quantidade:</label>
                <input type="number" name="quantidade" id="quantidade" min="1" value="1" required class="w-full p-2 rounded bg-gray-100 text-[#26535e] border border-gray-300 focus:ring-2 focus:ring-[#6cb3c3]">
            </div>

            <div class="mb-4">
                <label for="vagas" class="block mb-2 text-[#26535e]">Vagas Disponíveis:</label>
                <input type="text" id="vagas" readonly class="w-full p-2 rounded bg-gray-100 text-[#26535e] border border-gray-300 focus:ring-2 focus:ring-[#6cb3c3]">
            </div>

            <div class="flex justify-between">
                <button type="submit" class="bg-[#6cb3c3] text-white font-bold py-2 px-4 rounded hover:bg-[#547cac] focus:outline-none focus:ring-2 focus:ring-[#547cac]">Concluir</button>
                <button type="button" onclick="window.location.href='{{ route('dashboard') }}'" class="bg-gray-600 text-white font-bold py-2 px-4 rounded hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500">Cancelar</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Atualiza as vagas disponíveis com base no pacote selecionado
    document.getElementById('package_id').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const vagas = selectedOption.getAttribute('data-vagas');
        document.getElementById('vagas').value = vagas;
    });

    // Pesquisa dinâmica de clientes
    document.getElementById('client_search').addEventListener('input', function() {
        const term = this.value;
        if (term.length > 2) {
            fetch(`/clients/search?term=${term}`)
                .then(response => response.json())
                .then(data => {
                    let clientList = document.getElementById('client_list');
                    clientList.innerHTML = '';
                    data.forEach(client => {
                        let div = document.createElement('div');
                        div.textContent = `${client.nome} ${client.sobrenome}`;
                        div.style.padding = '8px';
                        div.style.cursor = 'pointer';
                        div.classList.add('hover:bg-gray-200');
                        div.addEventListener('click', function() {
                            document.getElementById('client_search').value = `${client.nome} ${client.sobrenome}`;
                            document.getElementById('client_id').value = client.id;
                            clientList.style.display = 'none';
                        });
                        clientList.appendChild(div);
                    });
                    clientList.style.display = 'block';
                });
        } else {
            document.getElementById('client_list').style.display = 'none';
        }
    });

    // Fecha a lista de clientes se clicar fora dela
    document.addEventListener('click', function(event) {
        if (!event.target.closest('#client_search') && !event.target.closest('#client_list')) {
            document.getElementById('client_list').style.display = 'none';
        }
    });
</script>
@endsection
