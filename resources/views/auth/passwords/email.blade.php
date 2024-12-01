@extends('master')

@section('content')
    <h2>Recuperar Senha</h2>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <form action="{{ route('password.email') }}" method="POST">
        @csrf
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <button type="submit">Enviar Link de Redefinição de Senha</button>
    </form>
@endsection
