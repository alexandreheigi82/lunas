@extends('master')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-[#f4f7fb]">
    <div class="p-8 rounded-lg shadow-lg w-full max-w-4xl">
        <h2 class="text-3xl font-bold text-center mb-6 text-[#6cb3c3]">Pacotes Desativados</h2>

        @if ($packages->isNotEmpty())
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($packages as $package)
            <div class="p-6 mb-6 rounded-2xl shadow-lg bg-[#f9f9f9] hover:bg-[#eef1f6] transition-all duration-300 ease-in-out">
                <h3 class="text-2xl font-bold mb-3 text-[#333333] hover:text-[#6cb3c3] transition-colors duration-200">{{ $package->titulo }}</h3>
                <p class="mb-3 text-[#555555]">{{ $package->descricao }}</p>
                <p class="mb-2 text-[#6cb3c3] font-semibold">Valor: {{ $package->valor }}</p>
                <p class="mb-2 text-[#6cb3c3] font-semibold">Vagas: {{ $package->vagas }}</p>

                @if ($package->imagem)
                <img src="{{ asset('storage/' . $package->imagem) }}" alt="{{ $package->titulo }}" class="mb-4 w-full rounded-2xl shadow-md object-cover h-48">
                @endif

                <a href="{{ $package->link }}" class="text-[#6cb3c3] hover:underline mb-4 inline-block transition duration-200">Link: Fale conosco</a>
                
                <div class="flex space-x-4 mt-4">
                    <a href="{{ route('packages.show', ['package' => $package->id]) }}" class="bg-[#6cb3c3] text-white py-2 px-6 rounded-lg hover:bg-[#547cac] transition duration-300 ease-in-out">Detalhes</a>
                    <a href="{{ route('packages.edit', ['package' => $package->id]) }}" class="bg-[#f1f1f1] text-[#6cb3c3] py-2 px-6 rounded-lg hover:bg-[#eef1f6] transition duration-300 ease-in-out">Editar</a>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <p class="text-center text-[#6cb3c3] font-semibold">Nenhum pacote desativado disponível.</p>
        @endif
    </div>
</div>
@endsection
