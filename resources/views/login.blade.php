<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Login - Lunas Tour</title>
    @vite('resources/css/app.css')

    <!-- Link para o Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body {
            background: linear-gradient(to right, #6cb3c3, #acd4e4);
            font-family: 'Arial', sans-serif;
            color: #26535e;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            background-color: white;
            padding: 2rem; /* Diminuído para reduzir a altura */
            border-radius: 8px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px; /* Largura aumentada */
            text-align: center;
        }

        .logo {
            width: 220px; /* Aumentado para 220px */
            height: 220px; /* Aumentado para 220px */
            margin-bottom: 2rem; /* Diminuído o espaçamento */
            border-radius: 50%;
            overflow: hidden;
            border: 4px solid #547cac;
        }

        .logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        h2 {
            font-size: 2.25rem; /* Ajustado para um tamanho intermediário */
            font-weight: bold;
            color: #26535e;
            margin-bottom: 1.5rem; /* Diminuído o espaçamento */
        }

        input:focus {
            border-color: #547cac;
            outline: none;
        }

        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 1rem;
            margin: 0.75rem 0;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 1.125rem;
            color: #26535e;
        }

        .eye-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            opacity: 0.6;
        }

        .button-enter {
            background-color: #547cac;
            color: white;
            padding: 1rem 2rem;
            border-radius: 8px;
            font-weight: bold;
            width: 100%;
            margin-top: 1.5rem; /* Diminuído o espaçamento */
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .button-enter:hover {
            background-color: #3e8e33;
        }

        .forgot-password {
            color: #547cac;
            text-decoration: underline;
            font-size: 1rem;
            margin-top: 1.25rem;
            display: block;
        }

        .remember-me {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            margin-top: 1rem;
            font-size: 1rem;
        }

        .remember-me input {
            margin-right: 0.5rem;
        }

        .error-message {
            color: red;
            margin-top: 0.5rem;
            font-size: 0.875rem;
        }

        .links {
            margin-top: 1.5rem;
            font-size: 1rem;
            color: #6a6a6a;
        }

        .links a {
            color: #547cac;
            text-decoration: underline;
        }

        .links a:hover {
            color: #26535e;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Logo -->
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Lunas Tour">
        </div>

        <!-- Título -->
        <h2>Login</h2>

        <!-- Exibir mensagem de erro de autenticação -->
        @if ($errors->has('email') || $errors->has('password'))
            <div class="error-message">
                <ul>
                    <li>Usuário ou senha incorretos</li>
                </ul>
            </div>
        @endif

        <!-- Formulário de login -->
        <form method="POST" action="{{ route('login') }}" id="loginForm" class="text-left">
            @csrf
            <div class="mb-4">
                <label for="email" class="font-bold text-[#333]">E-mail:</label>
                <input type="email" id="email" name="email" placeholder="Digite seu e-mail" required />
            </div>
            <div class="mb-4">
                <label for="password" class="font-bold text-[#333]">Senha:</label>
                <div class="relative">
                    <input type="password" id="password" name="password" placeholder="Digite sua senha" required />
                    <!-- Ícone de olho -->
                    <i id="togglePassword" class="fas fa-eye eye-icon" onclick="togglePassword()"></i>
                </div>
            </div>
            <div class="remember-me">
                <input type="checkbox" id="remember" name="remember" />
                <label for="remember">Lembrar-me</label>
            </div>
            <a href="{{ route('password.request') }}" class="forgot-password">Esqueci minha senha</a>
            <button type="submit" class="button-enter">Entrar</button>
        </form>

        <div class="links">
            <a href="/privacy-policy" class="hover:underline">Política de Privacidade</a> |
            <a href="/terms-of-service" class="hover:underline">Termos de Uso</a>
        </div>
    </div>

    <!-- Script para alternar a visibilidade da senha -->
    <script>
        function togglePassword() {
            const passwordField = document.getElementById("password");
            const eyeIcon = document.getElementById("togglePassword");

            // Alterar o tipo do campo de senha
            if (passwordField.type === "password") {
                passwordField.type = "text";  // Torna o campo visível
                eyeIcon.classList.replace("fa-eye", "fa-eye-slash");  // Troca o ícone para 'eye-slash'
            } else {
                passwordField.type = "password";  // Torna o campo oculto
                eyeIcon.classList.replace("fa-eye-slash", "fa-eye");  // Troca o ícone para 'eye'
            }
        }
    </script>
</body>
</html>
