<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        Log::info('Verificando e-mail', ['email' => $request->email]);

        // Verificar se o e-mail existe na tabela users
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            Log::warning('E-mail não registrado', ['email' => $request->email]);
            return back()->withErrors(['email' => 'O endereço de e-mail não está registrado no nosso sistema.']);
        }

        Log::info('Usuário encontrado', ['user' => $user->email]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        Log::info('Status do envio do link', ['status' => $status]);

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with(['status' => 'Enviamos o link de redefinição de senha para o seu e-mail.']);
        } else {
            return back()->withErrors(['email' => 'Ocorreu um erro ao enviar o link de redefinição de senha.']);
        }
    }
}
