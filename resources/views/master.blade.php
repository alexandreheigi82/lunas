<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lunas Tour</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @vite('resources/css/app.css')
    @yield('styles')

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
</div>
<body>
    <!-- Cabeçalho -->
    <header class="header">
        <a href="{{ route('dashboard') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Lunas Tour">
        </a>
        <nav class="nav-links">
            <a href="{{ route('dashboard') }}" class="text-[#acd4e4] px-4 py-2 rounded hover:bg-[#547cac]">Home</a>
            <a href="{{ route('clients.index') }}">Clientes</a>
            <a href="{{ route('users.index') }}">Usuários</a>
            <a href="{{ route('sales.index') }}">Vendas</a>
        </nav>
        <div class="user-info" id="user-dropdown-toggle">
            @if(Auth::check())
                Usuário: {{ Auth::user()->nome }}
                <div class="dropdown" id="user-dropdown">
                    <a href="{{ route('users.edit', Auth::user()->id) }}">Alterar Login</a>
                    <a href="{{ route('packages.create') }}">Criar Pacote de Turismo</a>
                    <a href="{{ route('packages.inactive') }}">Pacotes Inativos</a>
                    <a href="{{ route('packages.index') }}">Ver Pacotes de Turismo</a>
                    <form action="{{ route('logout') }}" method="POST" id="logout-form" class="inline-block">
                        @csrf
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    </form>
                </div>
            @else
                <a href="{{ route('login.form') }}">Login</a>
            @endif
        </div>
    </header>

    <nav>
        <ul>
            <li><a href="{{ route('home') }}"></a></li>
            <li><a href="{{ route('dashboard') }}"></a></li>
            @if(Auth::check())
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"></button>
                    </form>
                </li>
            @else
                <li><a href="{{ route('login.form') }}">Login</a></li>
            @endif
        </ul>
    </nav>

    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <!-- Adicionar mensagens de feedback -->
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </div>

    <!-- Script para dropdown -->
    <script>
        document.getElementById('user-dropdown-toggle').addEventListener('click', function() {
            const dropdown = document.getElementById('user-dropdown');
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        });
    </script>

    <!-- Rodapé -->
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
</body>
</html>
