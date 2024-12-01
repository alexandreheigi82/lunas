@extends('master')

@section('content')
<div class="min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-4xl">
        <h2 class="text-3xl font-bold text-center mb-6 text-[#6cb3c3]">Cadastrar Cliente</h2>

        @if ($errors->any())
        <div class="bg-red-500 text-white p-4 mb-4 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('clients.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Grid para organizar campos -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-4">
                    <input type="email" id="email" name="email" placeholder="Email" required
                        class="w-full p-3 rounded-lg bg-[#f1f1f1] text-[#26535e] focus:ring-2 focus:ring-[#6cb3c3] border-none">
                </div>
                <div class="mb-4">
                    <input type="text" id="cpf" name="cpf" placeholder="CPF" value="{{ old('cpf') }}" required
                        class="w-full p-3 rounded-lg bg-[#f1f1f1] text-[#26535e] focus:ring-2 focus:ring-[#6cb3c3] border-none">
                </div>
                <div class="mb-4">
                    <input type="text" id="nome" name="nome" placeholder="Nome" required
                        class="w-full p-3 rounded-lg bg-[#f1f1f1] text-[#26535e] focus:ring-2 focus:ring-[#6cb3c3] border-none">
                </div>
                <div class="mb-4">
                    <input type="text" id="sobrenome" name="sobrenome" placeholder="Sobrenome" required
                        class="w-full p-3 rounded-lg bg-[#f1f1f1] text-[#26535e] focus:ring-2 focus:ring-[#6cb3c3] border-none">
                </div>
                <div class="mb-4">
                    <input type="text" id="telefone" name="telefone" placeholder="Telefone" required
                        class="w-full p-3 rounded-lg bg-[#f1f1f1] text-[#26535e] focus:ring-2 focus:ring-[#6cb3c3] border-none">
                </div>
                <div class="mb-4">
                    <input type="date" id="data_nascimento" name="data_nascimento" placeholder="Data de Nascimento" required
                        class="w-full p-3 rounded-lg bg-[#f1f1f1] text-[#26535e] focus:ring-2 focus:ring-[#6cb3c3] border-none">
                </div>
                <div class="mb-4">
                    <input type="text" id="cep" name="cep" placeholder="CEP" required
                        class="w-full p-3 rounded-lg bg-[#f1f1f1] text-[#26535e] focus:ring-2 focus:ring-[#6cb3c3] border-none">
                </div>
                <div class="mb-4">
                    <input type="text" id="logradouro" name="logradouro" placeholder="Logradouro" required
                        class="w-full p-3 rounded-lg bg-[#f1f1f1] text-[#26535e] focus:ring-2 focus:ring-[#6cb3c3] border-none">
                </div>
                <div class="mb-4">
                    <input type="text" id="numero" name="numero" placeholder="Número" required
                        class="w-full p-3 rounded-lg bg-[#f1f1f1] text-[#26535e] focus:ring-2 focus:ring-[#6cb3c3] border-none">
                </div>
                <div class="mb-4">
                    <input type="text" id="complemento" name="complemento" placeholder="Complemento"
                        class="w-full p-3 rounded-lg bg-[#f1f1f1] text-[#26535e] focus:ring-2 focus:ring-[#6cb3c3] border-none">
                </div>
                <div class="mb-4">
                    <input type="text" id="bairro" name="bairro" placeholder="Bairro" required
                        class="w-full p-3 rounded-lg bg-[#f1f1f1] text-[#26535e] focus:ring-2 focus:ring-[#6cb3c3] border-none">
                </div>
                <div class="mb-4">
                    <input type="text" id="cidade" name="cidade" placeholder="Cidade" required
                        class="w-full p-3 rounded-lg bg-[#f1f1f1] text-[#26535e] focus:ring-2 focus:ring-[#6cb3c3] border-none">
                </div>
                <div class="mb-4">
                    <input type="text" id="estado" name="estado" placeholder="Estado" required
                        class="w-full p-3 rounded-lg bg-[#f1f1f1] text-[#26535e] focus:ring-2 focus:ring-[#6cb3c3] border-none">
                </div>

                <!-- Campo Situação (Ativo/Inativo) -->
                <div class="mb-6 flex items-center">
                    <label class="mr-3 text-[#26535e]">Ativo:</label>
                    <input type="checkbox" id="situacao" name="situacao" value="1" checked class="text-[#6cb3c3] focus:ring-[#6cb3c3] border-none">
                </div>
            </div>

            <!-- Botões de ação -->
            <div class="flex justify-between mt-6">
                <button type="submit" class="bg-[#6cb3c3] text-white font-bold py-3 px-6 rounded-lg hover:bg-[#547cac] focus:outline-none focus:ring-2 focus:ring-[#547cac]">
                    Salvar
                </button>
            <!-- Botões de ação -->
                <button type="button" onclick="window.location.href='{{ route('clients.index') }}'" class="bg-gray-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-gray-400">Cancelar</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('cep').addEventListener('blur', function() {
        const cep = this.value.replace(/\D/g, '');
        if (cep) {
            fetch(`https://viacep.com.br/ws/${cep}/json/`) // Corrigi aspas aqui
                .then(response => response.json())
                .then(data => {
                    if (!('erro' in data)) {
                        document.getElementById('logradouro').value = data.logradouro;
                        document.getElementById('complemento').value = data.complemento;
                        document.getElementById('bairro').value = data.bairro;
                        document.getElementById('cidade').value = data.localidade;
                        document.getElementById('estado').value = data.uf;
                    } else {
                        alert('CEP não encontrado.');
                    }
                })
                .catch(error => {
                    alert('Erro ao buscar o CEP. Tente novamente.');
                });
        }
    });
</script>
@endsection
