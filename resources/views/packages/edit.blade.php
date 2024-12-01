@extends('master')

@section('content')
<div class="min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-4xl">
        <h2 class="text-3xl font-bold text-center mb-6 text-[#6cb3c3]">Editar Pacote de Turismo</h2>

        @if ($errors->any())
        <div class="bg-red-500 text-white p-4 mb-4 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('packages.update', ['package' => $package->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!-- Grid com duas colunas para título, descrição e valor -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-4">
                    <input type="text" id="titulo" name="titulo" value="{{ $package->titulo }}" placeholder="Título" required class="w-full p-3 rounded-lg bg-[#f1f1f1] text-[#26535e] focus:border-[#6cb3c3] focus:ring-2 focus:ring-[#6cb3c3] border-none">
                </div>
                <div class="mb-4">
                    <textarea id="descricao" name="descricao" placeholder="Descrição" required class="w-full p-3 rounded-lg bg-[#f1f1f1] text-[#26535e] focus:border-[#6cb3c3] focus:ring-2 focus:ring-[#6cb3c3] border-none">{{ $package->descricao }}</textarea>
                </div>
            </div>

            <!-- Grid com valor e vagas -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-4">
                    <input type="number" step="0.01" id="valor" name="valor" value="{{ $package->valor }}" placeholder="Valor" required class="w-full p-3 rounded-lg bg-[#f1f1f1] text-[#26535e] focus:border-[#6cb3c3] focus:ring-2 focus:ring-[#6cb3c3] border-none">
                </div>
                <div class="mb-4">
                    <input type="number" id="vagas" name="vagas" value="{{ $package->vagas }}" placeholder="Vagas" required class="w-full p-3 rounded-lg bg-[#f1f1f1] text-[#26535e] focus:border-[#6cb3c3] focus:ring-2 focus:ring-[#6cb3c3] border-none">
                </div>
            </div>

            <!-- Input de imagem -->
            <div class="mb-4">
                <input type="file" id="imagem" name="imagem" class="w-full p-3 rounded-lg bg-[#f1f1f1] text-[#26535e] focus:border-[#6cb3c3] focus:ring-2 focus:ring-[#6cb3c3] border-none">
            </div>

            <!-- Input de link -->
            <div class="mb-4">
                <input type="url" id="link" name="link" value="{{ $package->link }}" placeholder="Link" class="w-full p-3 rounded-lg bg-[#f1f1f1] text-[#26535e] focus:border-[#6cb3c3] focus:ring-2 focus:ring-[#6cb3c3] border-none">
            </div>

            <!-- Seleção de categoria e tipo -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-4">
                    <select id="categoria" name="categoria" required class="w-full p-3 rounded-lg bg-[#f1f1f1] text-[#26535e] focus:border-[#6cb3c3] focus:ring-2 focus:ring-[#6cb3c3] border-none">
                        <option value="Passagens" {{ $package->categoria == 'Passagens' ? 'selected' : '' }}>Passagens</option>
                        <option value="Hotéis" {{ $package->categoria == 'Hotéis' ? 'selected' : '' }}>Hotéis</option>
                        <option value="Pacotes" {{ $package->categoria == 'Pacotes' ? 'selected' : '' }}>Pacotes</option>
                        <option value="Cruzeiros" {{ $package->categoria == 'Cruzeiros' ? 'selected' : '' }}>Cruzeiros</option>
                    </select>
                </div>
                <div class="mb-4">
                    <select id="tipo" name="tipo" required class="w-full p-3 rounded-lg bg-[#f1f1f1] text-[#26535e] focus:border-[#6cb3c3] focus:ring-2 focus:ring-[#6cb3c3] border-none">
                        <option value="Tranquilo" {{ $package->tipo == 'Tranquilo' ? 'selected' : '' }}>Tranquilo</option>
                        <option value="Urbano" {{ $package->tipo == 'Urbano' ? 'selected' : '' }}>Urbano</option>
                        <option value="Religioso" {{ $package->tipo == 'Religioso' ? 'selected' : '' }}>Religioso</option>
                        <option value="Ecoturismo" {{ $package->tipo == 'Ecoturismo' ? 'selected' : '' }}>Ecoturismo</option>
                        <option value="Internacional" {{ $package->tipo == 'Internacional' ? 'selected' : '' }}>Internacional</option>
                        <option value="Gastronômico" {{ $package->tipo == 'Gastronômico' ? 'selected' : '' }}>Gastronômico</option>
                        <option value="Esportivo" {{ $package->tipo == 'Esportivo' ? 'selected' : '' }}>Esportivo</option>
                    </select>
                </div>
            </div>

            <!-- Situação como checkbox -->
            <div class="mb-6 flex items-center">
                <label class="mr-3 text-[#26535e]">Ativo:</label>
                <input type="checkbox" id="situacao" name="situacao" {{ $package->situacao ? 'checked' : '' }} value="1" class="text-[#6cb3c3] focus:ring-[#6cb3c3] border-none">
            </div>

            <!-- Botões de ação -->
            <div class="flex justify-between mt-6">
                <button type="submit" class="bg-[#6cb3c3] text-white font-bold py-3 px-6 rounded-lg hover:bg-[#547cac] focus:outline-none focus:ring-2 focus:ring-[#547cac]">Salvar</button>
            <!-- Botões de ação -->
            <button type="button" onclick="window.location.href='{{ route('clients.index') }}'" class="bg-gray-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-gray-400">Cancelar</button>
            </div>
        </form>
    </div>
</div>
@endsection
