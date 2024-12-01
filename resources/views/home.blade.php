<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
@vite('resources/css/app.css')
<style>
    body {
        background: linear-gradient(to right, #6cb3c3, #acd4e4);
        font-family: 'Arial', sans-serif;
        margin: 0;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        color: #26535e;
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.5rem 2rem;
        background-color: #26535e;
        color: white;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .header img {
        width: 160px;
        height: auto;
    }

    .nav-links a {
        margin: 0 1rem;
        color: #acd4e4;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: bold;
        text-decoration: none;
        transition: background-color 0.3s, color 0.3s;
    }

    .nav-links a:hover {
        background-color: #547cac;
        color: white;
    }

    .user-info {
        background-color: #547cac;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 1rem;
        cursor: pointer;
        position: relative;
    }

    .dropdown {
        display: none;
        position: absolute;
        right: 0;
        top: 100%;
        background-color: white;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        z-index: 10;
        min-width: 200px;
    }

    .dropdown a {
        display: block;
        padding: 0.5rem 1rem;
        color: #26535e;
        text-decoration: none;
        border-bottom: 1px solid #ddd;
        transition: background-color 0.3s;
    }

    .dropdown a:hover {
        background-color: #f1f1f1;
    }

    .dropdown a:last-child {
        border-bottom: none;
    }

    .sidebar {
        background-color: white;
        border-radius: 8px;
        padding: 1rem;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .types-list li {
        padding: 0.5rem 1rem;
        margin: 0.5rem 0;
        background-color: #acd4e4;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s;
    }

    .types-list li:hover {
        background-color: #6cb3c3;
        color: white;
    }

    .content h2 {
        text-align: center;
        margin-bottom: 1rem;
    }

    .destaques {
        margin-top: 1.5rem;
    }

    .destaques h2 {
        margin-bottom: 1rem;
    }

    .pacote-card {
        background-color: white;
        border-radius: 8px;
        padding: 1rem;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        margin: 0.5rem 0;
    }

    .pacote-card:hover {
        transform: scale(1.02);
        transition: transform 0.3s;
    }
    footer {
    background-color: #547cac;
    color: white;
    padding: 2rem 1rem; /* Reduzido de 4rem para 2rem */
    font-family: 'Poppins', sans-serif;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    box-shadow: 0 -5px 15px rgba(0, 0, 0, 0.1);
}

footer h2, footer h4 {
    font-weight: 600;
    margin-bottom: 1rem; /* Reduzido de 1.5rem para 1rem */
}

footer p {
    margin-bottom: 0.5rem; /* Reduzido de 0.75rem para 0.5rem */
    font-size: 0.9rem; /* Um pouco menor */
    line-height: 1.4; /* Reduzido para diminuir altura */
    color: #dbe7f2;
}

footer .sobre, footer .contatos {
    max-width: 600px;
    margin-bottom: 1.5rem; /* Reduzido de 2rem para 1.5rem */
    padding: 0.5rem 0; /* Reduzido de 1rem para 0.5rem */
}

footer .sobre {
    border-top: 1px solid #dbe7f2;
    padding-top: 1.5rem; /* Reduzido de 2rem para 1.5rem */
}

footer a {
    text-decoration: none;
    color: #acd4e4;
    font-weight: 400;
    transition: color 0.3s;
}

footer a:hover {
    color: white;
}


</style>

<body>

    <div class="">
        <!-- Cabeçalho -->
        <header class="flex justify-between items-center p-4 bg-[#26535e] text-white shadow-lg mb-6"> <!-- retirado: text-white shadow-lg mb-6 -->
            <!-- Logo e Navegação Centralizada -->
            <div class="flex items-center space-x-8 w-full">
                <a href="{{ route('home') }}" class="flex-shrink-0">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Lunas Tour" class="w-40 h-auto">
                </a>

                <nav class="nav-links flex justify-center flex-grow space-x-4">
                    <a href="{{ route('home') }}" class="text-[#acd4e4] px-4 py-2 rounded hover:bg-[#547cac]">Home</a>
                    <a href="#sobre" class="text-[#acd4e4] px-4 py-2 rounded hover:bg-[#547cac]">Sobre</a>
                    <a href="#contatos" class="text-[#acd4e4] px-4 py-2 rounded hover:bg-[#547cac]">Contatos</a>
                </nav>

            </div>
        </header>
    </div>

    <!-- Botão de Login
                <div class="flex-shrink-0">
                    @if (Auth::check())
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-[#547cac] text-white py-2 px-4 rounded hover:bg-[#26535e]">Login</button>
                    </form>
                    @else
                    <a href="{{ route('login.form') }}" class="bg-[#547cac] text-white py-2 px-4 rounded hover:bg-[#26535e]">Login</a>
                    @endif
                </div> -->
    </div>
    </header>

    <!-- Conteúdo Principal -->
    <div class="flex flex-col md:flex-row space-y-6 md:space-y-0">
        <aside class="w-auto md:w-1/5 bg-white p-6 shadow-lg md:min-h-screen border-r border-gray-200">
            <h3 class="text-[#26535e] font-semibold text-xl mb-6 text-center">Tipos de Passeios</h3>
            <ul class="space-y-4">
                <li>
                    <a href="{{ route('home', ['tipo' => 'Todos']) }}"
                        class="text-[#26535e] font-semibold text-lg px-4 py-2 hover:bg-[#bed8e0] cursor-pointer rounded-md text-left 
                   @if(request()->get('tipo') == 'Todos') bg-[#bed8e0] @endif">
                        Todos
                    </a>
                </li>
                <li>
                    <a href="{{ route('home', ['tipo' => 'Tranquilo']) }}"
                        class="text-[#26535e] font-semibold text-lg px-4 py-2 hover:bg-[#bed8e0] cursor-pointer rounded-md text-left 
                   @if(request()->get('tipo') == 'Tranquilo') bg-[#bed8e0] @endif">
                        Tranquilo
                    </a>
                </li>
                <li>
                    <a href="{{ route('home', ['tipo' => 'Urbano']) }}"
                        class="text-[#26535e] font-semibold text-lg px-4 py-2 hover:bg-[#bed8e0] cursor-pointer rounded-md text-left 
                   @if(request()->get('tipo') == 'Urbano') bg-[#bed8e0] @endif">
                        Urbano
                    </a>
                </li>
                <li>
                    <a href="{{ route('home', ['tipo' => 'Religioso']) }}"
                        class="text-[#26535e] font-semibold text-lg px-4 py-2 hover:bg-[#bed8e0] cursor-pointer rounded-md text-left 
                   @if(request()->get('tipo') == 'Religioso') bg-[#bed8e0] @endif">
                        Religioso
                    </a>
                </li>
                <li>
                    <a href="{{ route('home', ['tipo' => 'Ecoturismo']) }}"
                        class="text-[#26535e] font-semibold text-lg px-4 py-2 hover:bg-[#bed8e0] cursor-pointer rounded-md text-left 
                   @if(request()->get('tipo') == 'Ecoturismo') bg-[#bed8e0] @endif">
                        Ecoturismo
                    </a>
                </li>
                <li>
                    <a href="{{ route('home', ['tipo' => 'Internacional']) }}"
                        class="text-[#26535e] font-semibold text-lg px-4 py-2 hover:bg-[#bed8e0] cursor-pointer rounded-md text-left 
                   @if(request()->get('tipo') == 'Internacional') bg-[#bed8e0] @endif">
                        Internacional
                    </a>
                </li>
                <li>
                    <a href="{{ route('home', ['tipo' => 'Gastronômico']) }}"
                        class="text-[#26535e] font-semibold text-lg px-4 py-2 hover:bg-[#bed8e0] cursor-pointer rounded-md text-left 
                   @if(request()->get('tipo') == 'Gastronômico') bg-[#bed8e0] @endif">
                        Gastronômico
                    </a>
                </li>
                <li>
                    <a href="{{ route('home', ['tipo' => 'Esportivo']) }}"
                        class="text-[#26535e] font-semibold text-lg px-4 py-2 hover:bg-[#bed8e0] cursor-pointer rounded-md text-left 
                   @if(request()->get('tipo') == 'Esportivo') bg-[#bed8e0] @endif">
                        Esportivo
                    </a>
                </li>
            </ul>
        </aside>

        <main class="flex-1 bg-white p-6">
            <h2 class="text-3xl font-bold text-center mb-6 text-[#26535e]">Bem-vindo ao Lunas Tour</h2>
            <section>
                <h3 class="text-2xl font-bold text-center mb-4 text-[#26535e]">Pacotes Disponíveis</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @if ($packages->isNotEmpty())
                    @foreach ($packages as $package)
                    @if ($package->situacao)
                    <div class="pacote-card bg-white p-4 rounded-lg border border-[#6cb3c3]">
                        <h4 class="text-xl font-bold mb-2 text-[#26535e]">{{ $package->titulo }}</h4>
                        <p class="mb-2 text-[#26535e]">{{ $package->descricao }}</p>
                        <p class="mb-2 text-[#26535e]">Valor: R$ {{ number_format($package->valor, 2, ',', '.') }}</p>
                        <p class="mb-2 text-[#26535e]">Vagas: {{ $package->vagas }}</p>
                        @if ($package->imagem)
                        <img src="{{ asset('storage/' . $package->imagem) }}" alt="{{ $package->titulo }}" class="mb-2 w-full h-48 object-cover rounded">
                        @endif
                        <a href="{{ $package->link }}" class="text-[#547cac] hover:underline mb-2 block">Link: Fale conosco</a>
                        @if (Auth::check())

                        @endif
                    </div>
                    @endif
                    @endforeach
                    @else
                    <p class="text-center col-span-3 text-[#26535e]">Nenhum pacote disponível.</p>
                    @endif
                </div>
            </section>
        </main>
    </div>


    <!-- Pacotes Disponíveis -->
    <!-- <main class="flex-1 bg-white p-12">
    <h2 class="text-3xl font-bold text-center mb-6 text-[#26535e]">Bem-vindo ao Lunas Tour</h2>
    <section>
        <h3 class="text-2xl font-bold text-center mb-4 text-[#26535e]">Pacotes Disponíveis</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @if ($packages->isNotEmpty())
            @foreach ($packages as $package)
            @if ($package->situacao)
            <div class="pacote-card bg-white p-4 rounded-lg border border-[#6cb3c3]">
                <h4 class="text-xl font-bold mb-2 text-[#26535e]">{{ $package->titulo }}</h4>
                <p class="mb-2 text-[#26535e]">{{ $package->descricao }}</p>
                <p class="mb-2 text-[#26535e]">Valor: R$ {{ number_format($package->valor, 2, ',', '.') }}</p>
                <p class="mb-2 text-[#26535e]">Vagas: {{ $package->vagas }}</p>
                @if ($package->imagem)
                <img src="{{ asset('storage/' . $package->imagem) }}" alt="{{ $package->titulo }}" class="mb-2 w-full h-48 object-cover rounded">
                @endif
                <a href="{{ $package->link }}" class="text-[#547cac] hover:underline mb-2 block">Link: Fale conosco</a>
                @if (Auth::check())

                @endif
            </div>
            @endif
            @endforeach
            @else
            <p class="text-center col-span-3 text-[#26535e]">Nenhum pacote disponível.</p>
            @endif
        </div>
    </section>
</main> -->

    </div>
    </div>


</body>
<footer>
    <!-- Seção de Contato -->
    <div id="contatos" class="contatos">
        <h2>Entre em Contato</h2>
        <p>E-mail: <a href="mailto:contato@lunastour.com">contato@lunastour.com</a></p>
        <p>Telefone: <a href="tel:+551112345678">(11) 1234-5678</a></p>
        <p>Endereço: Rua das Viagens, 123 - São Paulo, SP</p>
    </div>

    <!-- Seção Sobre -->
    <div id="sobre" class="sobre">
        <h4>Sobre a Lunas Tour</h4>
        <p>
            Na Lunas Tour, transformamos viagens em experiências inesquecíveis. Somos especialistas em criar roteiros personalizados que combinam conforto, aventura e momentos únicos.
        </p>
        <p>
            Descubra o mundo com quem entende de viagens. Na Lunas Tour, seu destino é a nossa inspiração!
        </p>
    </div>
</footer>



</html>
