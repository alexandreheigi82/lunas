<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class ResetPasswordController extends Controller
{
    public function showResetForm($token)
    {
        return view('auth.passwords.reset', ['token' => $token]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'senha' => 'required|confirmed|min:8|regex:/[A-Z]/|regex:/[a-z]/|regex:/[0-9]/|regex:/[@$!%*?&#.]/',
            'senha_confirmation' => 'required|same:senha',
            'token' => 'required'
        ]);

        Log::info('Dados recebidos para redefinição', [
            'email' => $request->email,
            'senha' => $request->senha,
            'senha_confirmation' => $request->senha_confirmation,
            'token' => $request->token
        ]);

        // Verifique se o usuário existe na tabela correta
        $user = DB::table('users_tabela')->where('email', $request->email)->first();
        if (!$user) {
            Log::error('Usuário não encontrado com o email fornecido', ['email' => $request->email]);
            return back()->withErrors(['email' => 'O email fornecido não foi encontrado.']);
        }

        Log::info('Usuário encontrado', ['email' => $request->email]);

        // Processo de redefinição de senha
        DB::table('users_tabela')->where('email', $request->email)->update(['senha' => Hash::make($request->senha)]);

        Log::info('Senha redefinida com sucesso para o usuário', ['email' => $request->email]);

        return redirect()->route('login.form')->with('status', 'Sua senha foi redefinida com sucesso.');
    }
}
