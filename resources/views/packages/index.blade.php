@extends('master')

@section('content')
<div class="min-h-screen flex items-center justify-center p-6">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-4xl">
        <h2 class="text-3xl font-bold text-center mb-6 text-[#6cb3c3]">Pacotes de Turismo</h2>
        
        <!-- Botão Criar Pacote -->
        <div class="text-center mb-6">
            <a href="{{ route('packages.create') }}" class="bg-[#6cb3c3] text-white font-bold py-2 px-4 rounded-lg hover:bg-[#547cac]">Criar pacote de turismo</a>
        </div>

        

        <!-- Filtros de Categoria e Tipo -->
        <form method="GET" action="{{ route('packages.index') }}" class="mb-6 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="categoria" class="block mb-2">Categoria:</label>
                <select id="categoria" name="categoria" class="w-full p-3 rounded-lg bg-[#f1f1f1] text-[#26535e] focus:border-[#6cb3c3] focus:ring-2 focus:ring-[#6cb3c3]">
                    <option value="">Todas</option>
                    <option value="Passagens">Passagens</option>
                    <option value="Hotéis">Hotéis</option>
                    <option value="Pacotes">Pacotes</option>
                    <option value="Cruzeiros">Cruzeiros</option>
                </select>
            </div>
            <div>
                <label for="tipo" class="block mb-2">Tipo:</label>
                <select id="tipo" name="tipo" class="w-full p-3 rounded-lg bg-[#f1f1f1] text-[#26535e] focus:border-[#6cb3c3] focus:ring-2 focus:ring-[#6cb3c3]">
                    <option value="">Todos</option>
                    <option value="Tranquilo">Tranquilo</option>
                    <option value="Urbano">Urbano</option>
                    <option value="Religioso">Religioso</option>
                    <option value="Ecoturismo">Ecoturismo</option>
                    <option value="Internacional">Internacional</option>
                    <option value="Gastronômico">Gastronômico</option>
                    <option value="Esportivo">Esportivo</option>
                </select>
            </div>
            <div class="flex items-end justify-center">
                <button type="submit" class="bg-[#6cb3c3] text-white font-bold py-3 px-6 rounded-lg hover:bg-[#547cac] focus:outline-none focus:ring-2 focus:ring-[#547cac]">Filtrar</button>
            </div>
        </form>

        @if ($packages->isNotEmpty())
            @foreach ($packages as $package)
            <div class="bg-[#f1f1f1] p-6 mb-6 rounded-lg shadow-lg">
                <h3 class="text-xl font-bold mb-4 text-[#26535e]">{{ $package->titulo }}</h3>
                
                @if ($package->imagem)
                <img src="{{ asset('storage/' . $package->imagem) }}" alt="{{ $package->titulo }}" class="mb-4 w-48 rounded-lg">
                @endif

                <!-- Botão Detalhes -->
                <div class="text-center mt-4">
                    <a href="{{ route('packages.show', ['package' => $package->id]) }}" class="bg-[#6cb3c3] text-white font-bold py-2 px-6 rounded-lg hover:bg-[#547cac]">Detalhes</a>
                </div>
            </div>
            @endforeach
        @else
            <p class="text-center text-[#26535e]">Nenhum pacote disponível.</p>
        @endif
        <div class="text-center mb-6">
            <a href="{{ route('packages.inactive') }}" class="bg-gray-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-gray-500">Ver Pacotes Desativados</a>
        </div>

        <!-- Botão Voltar para o Dashboard -->
        <div class="text-center mb-6">
            <a href="{{ route('dashboard') }}" class="bg-[#6cb3c3] text-white font-bold py-2 px-4 rounded-lg hover:bg-[#547cac]">Voltar para o Dashboard</a>
        </div>
    </div>
</div>
@endsection