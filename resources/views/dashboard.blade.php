<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Lunas Tour</title>
    <link rel="icon" href="/public/images/lua.png" type="image/png">
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
    </style>
</head>

<body>
    <!-- Cabeçalho -->
    <header class="header">
    <a href="{{ route('dashboard') }}">
        <img src="{{ asset('images/logo.png') }}" alt="Logo Lunas Tour" class="mr-8">
    </a>
            <nav class="nav-links">
            <a href="{{ route('dashboard') }}" class="text-[#acd4e4] px-4 py-2 rounded hover:bg-[#547cac]">Home</a>
            <a href="{{ route('clients.index') }}">Clientes</a>
            <a href="{{ route('users.index') }}">Usuários</a>
            <a href="{{ route('sales.index') }}">Vendas</a>
        </nav>
        </a>

        <div class="user-info" id="user-dropdown-toggle">
            Usuário: {{ Auth::user()->nome }}
            <div class="dropdown" id="user-dropdown">
            <a href="{{ route('users.edit', Auth::user()->id) }}">Alterar Login</a>
                <!-- <a href="{{ route('clients.create') }}">Cadastrar Cliente</a>
                <a href="{{ route('clients.index') }}">Lista de Clientes</a> 
                <a href="{{ route('sales.create') }}">Efetuar Venda</a> -->
                <a href="{{ route('packages.create') }}">Criar Pacote de Turismo</a>
                <a href="{{ route('packages.inactive') }}">Pacotes Inativos</a>
                <a href="{{ route('packages.index') }}">Ver Pacotes de Turismo</a>
                <a href="{{ route('packages.inactive') }}">Pacotes Inativos</a>
                <!-- <a href="{{ route('users.create') }}">Cadastrar Novo Usuário</a>
                <a href="{{ route('users.index') }}">Visualizar Usuários</a>
                <a href="{{ route('sales.index') }}">Visualizar Vendas</a> -->

                <!-- Botão de Logout estilizado como link -->
                <form action="{{ route('logout') }}" method="POST" id="logout-form" class="inline-block">
                    @csrf
                    <a href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="text-[#547cac] hover:text-[#26535e] block py-2">
                        Logout
                    </a>
                </form>
            </div>
        </div>
        </div>
    </header>

    <!-- Conteúdo Principal -->
    <div class="flex flex-col md:flex-row space-y-6 md:space-y-0">
    <aside class="w-auto md:w-1/5 bg-white p-6 shadow-lg md:min-h-screen border-r border-gray-200">
        <h3 class="text-[#26535e] font-semibold text-xl mb-6 text-center">Tipos de Passeios</h3>
        <ul class="space-y-4">
            <li>
                <a href="{{ route('dashboard', ['tipo' => 'Todos']) }}" 
                   class="text-[#26535e] font-semibold text-lg px-4 py-2 hover:bg-[#bed8e0] cursor-pointer rounded-md text-left 
                   @if(request()->get('tipo') == 'Todos') bg-[#bed8e0] @endif">
                   Todos
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard', ['tipo' => 'Tranquilo']) }}" 
                   class="text-[#26535e] font-semibold text-lg px-4 py-2 hover:bg-[#bed8e0] cursor-pointer rounded-md text-left 
                   @if(request()->get('tipo') == 'Tranquilo') bg-[#bed8e0] @endif">
                   Tranquilo
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard', ['tipo' => 'Urbano']) }}" 
                   class="text-[#26535e] font-semibold text-lg px-4 py-2 hover:bg-[#bed8e0] cursor-pointer rounded-md text-left 
                   @if(request()->get('tipo') == 'Urbano') bg-[#bed8e0] @endif">
                   Urbano
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard', ['tipo' => 'Religioso']) }}" 
                   class="text-[#26535e] font-semibold text-lg px-4 py-2 hover:bg-[#bed8e0] cursor-pointer rounded-md text-left 
                   @if(request()->get('tipo') == 'Religioso') bg-[#bed8e0] @endif">
                   Religioso
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard', ['tipo' => 'Ecoturismo']) }}" 
                   class="text-[#26535e] font-semibold text-lg px-4 py-2 hover:bg-[#bed8e0] cursor-pointer rounded-md text-left 
                   @if(request()->get('tipo') == 'Ecoturismo') bg-[#bed8e0] @endif">
                   Ecoturismo
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard', ['tipo' => 'Internacional']) }}" 
                   class="text-[#26535e] font-semibold text-lg px-4 py-2 hover:bg-[#bed8e0] cursor-pointer rounded-md text-left 
                   @if(request()->get('tipo') == 'Internacional') bg-[#bed8e0] @endif">
                   Internacional
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard', ['tipo' => 'Gastronômico']) }}" 
                   class="text-[#26535e] font-semibold text-lg px-4 py-2 hover:bg-[#bed8e0] cursor-pointer rounded-md text-left 
                   @if(request()->get('tipo') == 'Gastronômico') bg-[#bed8e0] @endif">
                   Gastronômico
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard', ['tipo' => 'Esportivo']) }}" 
                   class="text-[#26535e] font-semibold text-lg px-4 py-2 hover:bg-[#bed8e0] cursor-pointer rounded-md text-left 
                   @if(request()->get('tipo') == 'Esportivo') bg-[#bed8e0] @endif">
                   Esportivo
                </a>
            </li>
        </ul>
    </aside>


        <!-- Conteúdo -->
        <main class="flex-1 bg-white p-6">
            <h2 class="text-3xl font-bold text-center mb-6 text-[#26535e]">Bem-vindo ao Lunas Tour</h2>
            <section>
                <h3 class="text-2xl font-bold text-center mb-4 text-[#26535e]">Pacotes Disponíveis</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @if ($packages->isNotEmpty())
                    @foreach ($packages as $package)
                    <div class="pacote-card bg-white p-4 rounded-lg shadow-lg border border-[#6cb3c3]">
                        <h4 class="text-xl font-bold mb-2 text-[#26535e]">{{ $package->titulo }}</h4>
                        <p class="mb-2 text-[#26535e]">{{ $package->descricao }}</p>
                        <p class="mb-2 text-[#26535e]">Valor: R$ {{ number_format($package->valor, 2, ',', '.') }}</p>
                        <p class="mb-2 text-[#26535e]">Vagas: {{ $package->vagas }}</p>

                        @if ($package->imagem)
                        <img src="{{ asset('storage/' . $package->imagem) }}" alt="{{ $package->titulo }}" class="mb-2 w-full h-48 object-cover rounded">
                        @endif
                        <a href="{{ $package->link }}" class="text-[#547cac] hover:underline mb-2 block">Link: Fale conosco</a>
                        <!-- Botão de Detalhes -->
                        <div class="flex space-x-2 mt-2">
                            <a href="{{ route('packages.show', ['package' => $package->id]) }}" class="bg-blue-500 text-white py-1 px-3 rounded hover:bg-blue-400">Detalhes</a>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <p class="text-center col-span-3 text-[#26535e]">Nenhum pacote disponível.</p>
                    @endif
                </div>
            </section>
        </main>

    </div>

    <!-- Script para dropdown -->
    <script>
        document.getElementById('user-dropdown-toggle').addEventListener('click', function() {
            const dropdown = document.getElementById('user-dropdown');
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        });
    </script>
</body>
<footer class="bg-[#547cac] py-6 mt-8 text-white text-center">
    <div class="max-w-3xl mx-auto">
        <h4 class="text-lg font-bold">Sobre a Lunas Tour</h4>
        <br>
        <p class="text-[#acd4e4]">Na Lunas Tour, transformamos viagens em experiências inesquecíveis.
            <br>
            Somos especialistas em criar roteiros personalizados que combinam conforto, aventura e momentos únicos.
            Com uma equipe apaixonada e dedicada, oferecemos pacotes de viagens que atendem a todos os estilos, sempre com o compromisso de superar expectativas.
        </p>
        <p class="text-[#acd4e4] mt-4">
            Descubra o mundo com quem entende de viagens. Na Lunas Tour, seu destino é a nossa inspiração!
        </p>
    </div>
</footer>

</html>