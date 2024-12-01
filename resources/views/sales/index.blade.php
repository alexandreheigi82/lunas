@extends('master')

@section('content')
<div class="min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-4xl">

        <h2 class="text-3xl font-semibold text-center mb-6 text-[#6cb3c3]">Lista de Vendas</h2>

        <!-- Campo de Pesquisa -->
        <form action="{{ route('sales.index') }}" method="GET" class="mb-4 flex justify-center space-x-4">
            <input type="text" name="search" placeholder="Pesquisar vendas" value="{{ request()->input('search') }}" class="w-full p-2 rounded-lg bg-gray-100 text-[#26535e] border border-gray-300 focus:ring-2 focus:ring-[#6cb3c3] focus:outline-none">
            <button type="submit" class="bg-[#6cb3c3] text-white font-semibold py-2 px-4 rounded-lg hover:bg-[#547cac] focus:outline-none focus:ring-2 focus:ring-[#547cac]">Pesquisar</button>
            <!-- <a href="{{ route('dashboard') }}" class="bg-gray-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400">Voltar</a> -->
        </form>

        @if(request()->has('search'))
        <div class="text-center mb-4">
            <a href="{{ route('sales.index') }}" class="bg-gray-600 text-white py-2 px-4 rounded-lg hover:bg-gray-500">Voltar à Lista de Vendas</a>
        </div>
        @endif

        <!-- Lista de Vendas -->
        <div class="overflow-x-auto mt-8">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#26535e] text-white">
                        <th class="p-2 border-b border-gray-300">ID Venda</th>
                        <th class="p-2 border-b border-gray-300">Cliente</th>
                        <th class="p-2 border-b border-gray-300">Pacote</th>
                        <th class="p-2 border-b border-gray-300">Quantidade</th>
                        <th class="p-2 border-b border-gray-300">ID Vendedor</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sales as $sale)
                    @if ($sale->package)
                    <tr class="bg-gray-100 hover:bg-gray-200">
                        <td class="p-2 border-b border-gray-300"><a href="{{ route('sales.show', ['sale' => $sale->id]) }}" class="text-[#6cb3c3] hover:underline"><strong>{{ $sale->id }}</strong></a></td>
                        <td class="p-2 border-b border-gray-300">{{ $sale->client->nome }} {{ $sale->client->sobrenome }}</td>
                        <td class="p-2 border-b border-gray-300">{{ $sale->package->titulo }}</td>
                        <td class="p-2 border-b border-gray-300">{{ $sale->quantidade }}</td>
                        <td class="p-2 border-b border-gray-300">{{ $sale->user_id }}</td>
                    </tr>
                    @else
                    <tr class="bg-gray-100 hover:bg-gray-200">
                        <td colspan="5" class="p-2 border-b border-gray-300 text-center text-[#26535e]">Pacote relacionado foi removido.</td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Botão de Criar Novo -->
        <div class="flex justify-between items-center mt-8">
            <a href="{{ route('sales.create') }}" 
               class="bg-[#6cb3c3] text-white py-3 px-6 rounded-lg hover:bg-[#547cac] focus:outline-none focus:ring-2 focus:ring-[#547cac]">
                Criar Novo
            </a>
            <a href="{{ route('dashboard') }}" 
               class="bg-gray-500 text-white py-3 px-6 rounded-lg hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400">
                Voltar
            </a>
        </div>
        
    </div>
</div>
@endsection
