<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        Log::info('Tentativa de login com o email:', ['email' => $request->email]);

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8|regex:/[A-Z]/|regex:/[a-z]/|regex:/[0-9]/|regex:/[@$!%*?&#.]/'
        ]);

        $user = User::where('email', $request->email)->first();
        Log::info('Usuário encontrado:', ['user' => $user]);

        if ($user && Hash::check($request->password, $user->senha)) {
            Log::info('Senha correta, autenticando usuário');
            Auth::login($user);
            Log::info('Usuário autenticado, redirecionando para a home');
            return redirect()->route('dashboard')->with('status', 'Você está logado com sucesso!');
        }

        Log::warning('Credenciais não correspondem aos registros');
        return back()->withErrors(['email' => 'As credenciais não correspondem aos nossos registros.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.form');
    }
}
