<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('situacao', true)->get(); // Apenas usuários ativos
        return view('users', ['users' => $users]);
    }

    public function create()
    {
        return view('user_create');
    }

    public function store(Request $request)
    {
        Log::info('Entrou no método store do UserController');
        $request->validate(['nome' => 'required|string|max:255', 'sobrenome' => 'required|string|max:255', 'email' => 'required|string|email|max:255|unique:users_tabela', 'senha' => 'required|string|min:8|regex:/[A-Z]/|regex:/[a-z]/|regex:/[0-9]/|regex:/[@$!%*?&#.]/', 'situacao' => 'boolean',]);
        $user = new User();
        $user->nome = $request->input('nome');
        $user->sobrenome = $request->input('sobrenome');
        $user->email = $request->input('email');
        $user->senha = Hash::make($request->input('senha'));
        $user->situacao = $request->has('situacao') ? true : false;
        $user->save();
        return redirect()->route('users.index')->with('message', 'Usuário criado com sucesso!');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('user_show', ['user' => $user]);
    }

    public function edit(User $user)
    {
        return view('user_edit', ['user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        Log::info('Iniciando atualização do usuário');
        Log::info('Valor de situacao recebido: ' . $request->input('situacao'));

        $request->validate([
            'nome' => 'required|string|max:255',
            'sobrenome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users_tabela,email,' . $user->id,
            'senha' => 'nullable|string|min:8|regex:/[A-Z]/|regex:/[a-z]/|regex:/[0-9]/|regex:/[@$!%*?&#.]/',
            'situacao' => 'nullable|string',
        ]);

        $user->nome = $request->input('nome');
        $user->sobrenome = $request->input('sobrenome');
        $user->email = $request->input('email');
        if ($request->filled('senha')) {
            $user->senha = Hash::make($request->input('senha'));
        }
        $user->situacao = $request->has('situacao') ? true : false;

        Log::info('Valor de situacao após processamento: ' . $user->situacao);

        $user->save();

        return redirect()->route('users.show', ['user' => $user->id])->with('message', 'Usuário atualizado com sucesso!');
    }

    public function destroy(User $user)
    {
        $user->situacao = false;
        $user->save();

        return redirect()->route('users.index')->with('message', 'Usuário desativado com sucesso!');
    }

    public function inactive()
    {
        $users = User::where('situacao', false)->get(); // Apenas usuários inativos
        return view('users_inactive', ['users' => $users]);
    }

    public function reactivate($id)
    {
        $user = User::findOrFail($id);
        $user->situacao = true;
        $user->save();

        return redirect()->route('users.show', ['user' => $user->id])->with('message', 'Usuário reativado com sucesso!');
    }
}
