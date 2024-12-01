@extends('master')

@section('content')
<div class="min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-4xl">
        <h2 class="text-3xl font-bold text-center mb-6 text-[#6cb3c3]">Criar Pacote de Turismo</h2>

        @if ($errors->any())
        <div class="bg-red-500 text-white p-4 mb-4 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('packages.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Grid com duas colunas para título, descrição e valor -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-4">
                    <input type="text" id="titulo" name="titulo" placeholder="Título" required class="w-full p-3 rounded-lg bg-[#f1f1f1] text-[#26535e] focus:border-[#6cb3c3] focus:ring-2 focus:ring-[#6cb3c3] border-none">
                </div>
                <div class="mb-4">
                    <textarea id="descricao" name="descricao" placeholder="Descrição" required class="w-full p-3 rounded-lg bg-[#f1f1f1] text-[#26535e] focus:border-[#6cb3c3] focus:ring-2 focus:ring-[#6cb3c3] border-none"></textarea>
                </div>
            </div>

            <!-- Grid com valor e vagas -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-4">
                    <input type="text" id="valor" name="valor" placeholder="Valor" required class="w-full p-3 rounded-lg bg-[#f1f1f1] text-[#26535e] focus:border-[#6cb3c3] focus:ring-2 focus:ring-[#6cb3c3] border-none">
                </div>
                <div class="mb-4">
                    <input type="number" id="vagas" name="vagas" placeholder="Vagas" required class="w-full p-3 rounded-lg bg-[#f1f1f1] text-[#26535e] focus:border-[#6cb3c3] focus:ring-2 focus:ring-[#6cb3c3] border-none">
                </div>
            </div>

            <!-- Input de imagem -->
            <div class="mb-4">
                <input type="file" id="imagem" name="imagem" class="w-full p-3 rounded-lg bg-[#f1f1f1] text-[#26535e] focus:border-[#6cb3c3] focus:ring-2 focus:ring-[#6cb3c3] border-none">
            </div>

            <!-- Input de link -->
            <div class="mb-4">
                <input type="url" id="link" name="link" placeholder="Link" class="w-full p-3 rounded-lg bg-[#f1f1f1] text-[#26535e] focus:border-[#6cb3c3] focus:ring-2 focus:ring-[#6cb3c3] border-none">
            </div>

            <!-- Seleção de categoria e tipo -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-4">
                    <select id="categoria" name="categoria" required class="w-full p-3 rounded-lg bg-[#f1f1f1] text-[#26535e] focus:border-[#6cb3c3] focus:ring-2 focus:ring-[#6cb3c3] border-none">
                        <option value="Passagens">Passagens</option>
                        <option value="Hotéis">Hotéis</option>
                        <option value="Pacotes">Pacotes</option>
                        <option value="Cruzeiros">Cruzeiros</option>
                    </select>
                </div>
                <div class="mb-4">
                    <select id="tipo" name="tipo" required class="w-full p-3 rounded-lg bg-[#f1f1f1] text-[#26535e] focus:border-[#6cb3c3] focus:ring-2 focus:ring-[#6cb3c3] border-none">
                        <option value="Tranquilo">Tranquilo</option>
                        <option value="Urbano">Urbano</option>
                        <option value="Religioso">Religioso</option>
                        <option value="Ecoturismo">Ecoturismo</option>
                        <option value="Internacional">Internacional</option>
                        <option value="Gastronômico">Gastronômico</option>
                        <option value="Esportivo">Esportivo</option>
                    </select>
                </div>
            </div>

            <!-- Situação como checkbox -->
            <div class="mb-6 flex items-center">
                <label class="mr-3 text-[#26535e]">Ativo:</label>
                <input type="checkbox" id="situacao" name="situacao" value="1" checked class="text-[#6cb3c3] focus:ring-[#6cb3c3] border-none">
            </div>

            <!-- Botões de ação -->
            <div class="flex justify-between mt-6">
                <button type="submit" class="bg-[#6cb3c3] text-white font-bold py-3 px-6 rounded-lg hover:bg-[#547cac] focus:outline-none focus:ring-2 focus:ring-[#547cac]">Salvar</button>
                <button type="button" onclick="window.location='{{ route('dashboard') }}'" class="bg-[#f1f1f1] text-[#26535e] font-bold py-3 px-6 rounded-lg hover:bg-[#ddd] focus:outline-none focus:ring-2 focus:ring-[#ddd]">Cancelar</button>
            </div>
        </form>
        <script>
    document.addEventListener('DOMContentLoaded', function () {
        const valorInput = document.getElementById('valor');

        valorInput.addEventListener('input', function (e) {
            let value = e.target.value;
            value = value.replace(/\D/g, '');
            value = (value / 100).toFixed(2) + '';
            value = value.replace(".", ",");
            value = value.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
            e.target.value = value;
        });

        // Submit handler to convert back to number format
        const form = valorInput.closest('form');
        form.addEventListener('submit', function () {
            valorInput.value = valorInput.value.replace(/\./g, '').replace(',', '.');
        });
    });
</script>

    </div>
</div>
@endsection