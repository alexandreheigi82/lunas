@extends('master')

@section('content')
<div class="min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-4xl">
        <h2 class="text-3xl font-semibold text-center mb-6 text-[#6cb3c3]">Relatório da Venda #{{ $sale->id }}</h2>

        <div class="mb-4">
            <p><strong>Cliente:</strong> {{ $sale->client->nome }} {{ $sale->client->sobrenome }}</p>
            <p><strong>Pacote:</strong> {{ $sale->package->titulo }}</p>
            <p><strong>Descrição:</strong> {{ $sale->package->descricao }}</p>
            <p><strong>Valor:</strong> R$ {{ $sale->package->valor }}</p>
            <p><strong>Quantidade:</strong> {{ $sale->quantidade }}</p>
            <p><strong>Vendedor:</strong> {{ $sale->user->nome }}</p>
        </div>

        <div class="flex justify-between mb-4">
            <a href="{{ route('sales.edit', $sale->id) }}" class="bg-yellow-500 text-white py-2 px-4 rounded hover:bg-yellow-400">Editar</a>
            <form action="{{ route('sales.destroy', $sale->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Tem certeza que deseja excluir esta venda?')" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-400">Excluir</button>
            </form>
        </div>

        <div class="text-center">
            <a href="{{ route('dashboard') }}" class="bg-gray-600 text-white py-2 px-4 rounded hover:bg-gray-500">Voltar ao Painel de Controle</a>
        </div>
    </div>
</div>
@endsection
