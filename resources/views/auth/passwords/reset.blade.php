@extends('master')

@section('content')
    <h2>Redefinir Senha</h2>
    <form action="{{ route('password.update') }}" method="POST" onsubmit="return validatePassword()">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="senha">Nova Senha:</label>
            <input type="password" id="senha" name="senha" required>
        </div>
        <div>
            <label for="senha_confirmation">Confirmar Senha:</label>
            <input type="password" id="senha_confirmation" name="senha_confirmation" required>
        </div>
        <button type="submit">Redefinir Senha</button>
    </form>

    <script>
        function validatePassword() {
            var senha = document.getElementById("senha").value;
            var confirmSenha = document.getElementById("senha_confirmation").value;

            if (senha !== confirmSenha) {
                alert("As senhas não coincidem. Por favor, tente novamente.");
                return false;
            }
            return true;
        }
    </script>
@endsection
