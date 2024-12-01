@extends('master')

@section('content')
<div class="min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-4xl">
        <h2 class="text-3xl font-bold text-center mb-6 text-[#6cb3c3]">Editar Cliente</h2>

        @if ($errors->any())
        <div class="bg-red-500 text-white p-4 mb-4 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('clients.update', $client->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-4">
                    <input type="email" id="email" name="email" placeholder="Email" value="{{ $client->email }}" required
                        class="w-full p-3 rounded-lg bg-[#f1f1f1] text-[#26535e] focus:ring-2 focus:ring-[#6cb3c3] border-none">
                </div>
                <div class="mb-4">
                    <input type="text" id="cpf" name="cpf" placeholder="CPF" value="{{ $client->cpf }}" required
                        class="w-full p-3 rounded-lg bg-[#f1f1f1] text-[#26535e] focus:ring-2 focus:ring-[#6cb3c3] border-none">
                </div>
                <div class="mb-4">
                    <input type="text" id="nome" name="nome" placeholder="Nome" value="{{ $client->nome }}" required
                        class="w-full p-3 rounded-lg bg-[#f1f1f1] text-[#26535e] focus:ring-2 focus:ring-[#6cb3c3] border-none">
                </div>
                <div class="mb-4">
                    <input type="text" id="sobrenome" name="sobrenome" placeholder="Sobrenome" value="{{ $client->sobrenome }}" required
                        class="w-full p-3 rounded-lg bg-[#f1f1f1] text-[#26535e] focus:ring-2 focus:ring-[#6cb3c3] border-none">
                </div>
                <div class="mb-4">
                    <input type="text" id="telefone" name="telefone" placeholder="Telefone" value="{{ $client->telefone }}" required
                        class="w-full p-3 rounded-lg bg-[#f1f1f1] text-[#26535e] focus:ring-2 focus:ring-[#6cb3c3] border-none">
                </div>
                <div class="mb-4">
                    <input type="date" id="data_nascimento" name="data_nascimento" value="{{ $client->data_nascimento }}" required
                        class="w-full p-3 rounded-lg bg-[#f1f1f1] text-[#26535e] focus:ring-2 focus:ring-[#6cb3c3] border-none">
                </div>
                <div class="mb-4">
                    <input type="text" id="cep" name="cep" placeholder="CEP" value="{{ $client->cep }}" required
                        class="w-full p-3 rounded-lg bg-[#f1f1f1] text-[#26535e] focus:ring-2 focus:ring-[#6cb3c3] border-none">
                </div>
                <div class="mb-4">
                    <input type="text" id="logradouro" name="logradouro" placeholder="Logradouro" value="{{ $client->logradouro }}" required
                        class="w-full p-3 rounded-lg bg-[#f1f1f1] text-[#26535e] focus:ring-2 focus:ring-[#6cb3c3] border-none">
                </div>
                <div class="mb-4">
                    <input type="text" id="numero" name="numero" placeholder="Número" value="{{ $client->numero }}" required
                        class="w-full p-3 rounded-lg bg-[#f1f1f1] text-[#26535e] focus:ring-2 focus:ring-[#6cb3c3] border-none">
                </div>
                <div class="mb-4">
                    <input type="text" id="complemento" name="complemento" placeholder="Complemento" value="{{ $client->complemento }}"
                        class="w-full p-3 rounded-lg bg-[#f1f1f1] text-[#26535e] focus:ring-2 focus:ring-[#6cb3c3] border-none">
                </div>
                <div class="mb-4">
                    <input type="text" id="bairro" name="bairro" placeholder="Bairro" value="{{ $client->bairro }}" required
                        class="w-full p-3 rounded-lg bg-[#f1f1f1] text-[#26535e] focus:ring-2 focus:ring-[#6cb3c3] border-none">
                </div>
                <div class="mb-4">
                    <input type="text" id="cidade" name="cidade" placeholder="Cidade" value="{{ $client->cidade }}" required
                        class="w-full p-3 rounded-lg bg-[#f1f1f1] text-[#26535e] focus:ring-2 focus:ring-[#6cb3c3] border-none">
                </div>
                <div class="mb-4">
                    <input type="text" id="estado" name="estado" placeholder="Estado" value="{{ $client->estado }}" required
                        class="w-full p-3 rounded-lg bg-[#f1f1f1] text-[#26535e] focus:ring-2 focus:ring-[#6cb3c3] border-none">
                </div>

                <!-- Campo Situação (Ativo/Inativo) -->
                <div class="mb-6 flex items-center">
                    <label class="mr-3 text-[#26535e]">Ativo:</label>
                    <input type="checkbox" id="situacao" name="situacao" value="1" {{ $client->situacao ? 'checked' : '' }}
                        class="text-[#6cb3c3] focus:ring-[#6cb3c3] border-none">
                </div>
            </div>

            <!-- Botões de ação -->
            <div class="flex justify-between mt-6">
                <button type="submit" class="bg-[#6cb3c3] text-white font-bold py-3 px-6 rounded-lg hover:bg-[#547cac] focus:outline-none focus:ring-2 focus:ring-[#547cac]">
                    Salvar
                </button>
                <button type="button" onclick="window.location.href='{{ route('clients.index') }}'" class="bg-gray-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-gray-400">
                    Cancelar
                </button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mask-plugin/1.14.16/jquery.mask.min.js"></script>
<script>
    $(document).ready(function () {
        $('#cpf').mask('000.000.000-00');
        $('#telefone').mask('(00) 00000-0000');
        $('#cep').mask('00000-000');
        
        // Busca automática para o CEP (quando o campo perde o foco ou é alterado)
        $('#cep').on('blur keyup', function () {
            const cep = $(this).val().replace(/\D/g, '');
            if (cep.length === 8) {  // Garante que o CEP tem 8 caracteres
                fetch(`https://viacep.com.br/ws/${cep}/json/`)
                    .then(response => response.json())
                    .then(data => {
                        if (!('erro' in data)) {
                            $('#logradouro').val(data.logradouro);
                            $('#complemento').val(data.complemento);
                            $('#bairro').val(data.bairro);
                            $('#cidade').val(data.localidade);
                            $('#estado').val(data.uf);
                        } else {
                            alert('CEP não encontrado.');
                        }
                    })
                    .catch(error => {
                        alert('Erro ao buscar o CEP. Tente novamente.');
                    });
            }
        });
    });
</script>
@endsection
