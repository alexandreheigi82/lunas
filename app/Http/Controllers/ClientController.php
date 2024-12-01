<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::orderBy('nome')->get();
        return view('clients.index', compact('clients'));
    }



    public function create()
    {
        return view('clients.create');
    }

    public function search(Request $request)
    {
        $term = $request->input('term'); // Buscar apenas clientes ativos
        $clients = Client::where('situacao', 1)
            ->where(function ($query) use ($term) {
                $query->where('nome', 'LIKE', "%{$term}%")
                    ->orWhere('sobrenome', 'LIKE', "%{$term}%");
            })
            ->get();
        return response()->json($clients);
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:clients,email',
            'cpf' => ['required', 'unique:clients,cpf', new \App\Rules\Cpf], // Manter a validação do CPF
            'nome' => 'required|string|max:255',
            'sobrenome' => 'required|string|max:255',
            'telefone' => 'required|string|max:15',
            'data_nascimento' => 'required|date',
            'cep' => 'required|string|max:9',
            'logradouro' => 'required|string|max:255',
            'numero' => 'required|string|max:10',
            'complemento' => 'nullable|string|max:255',
            'bairro' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'estado' => 'required|string|max:2',
            'situacao' => 'boolean', // Adicione esta linha para validar o campo ativo
        ]);

        Client::create([
            'nome' => $request->input('nome'),
            'sobrenome' => $request->input('sobrenome'),
            'email' => $request->input('email'),
            'senha' => Hash::make($request->input('senha')),
            'cpf' => $request->input('cpf'),
            'telefone' => $request->input('telefone'),
            'data_nascimento' => $request->input('data_nascimento'),
            'cep' => $request->input('cep'),
            'logradouro' => $request->input('logradouro'),
            'numero' => $request->input('numero'),
            'complemento' => $request->input('complemento'),
            'bairro' => $request->input('bairro'),
            'cidade' => $request->input('cidade'),
            'estado' => $request->input('estado'),
            'situacao' => $request->has('situacao') ? 1 : 0,
        ]);

        return redirect()->route('clients.index')->with('success', 'Cliente cadastrado com sucesso!');
    }

    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email|unique:clients,email,' . $id,
            'cpf' => ['required', 'unique:clients,cpf,' . $id, new \App\Rules\Cpf], // Manter a validação do CPF
            'nome' => 'required|string|max:255',
            'sobrenome' => 'required|string|max:255',
            'telefone' => 'required|string|max:15',
            'data_nascimento' => 'required|date',
            'cep' => 'required|string|max:9',
            'logradouro' => 'required|string|max:255',
            'numero' => 'required|string|max:10',
            'complemento' => 'nullable|string|max:255',
            'bairro' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'estado' => 'required|string|max:2',
            'situacao' => 'boolean', // Valida como booleano
        ]);

        $client = Client::findOrFail($id);
        $data = $request->all();
        $data['situacao'] = $request->has('situacao') ? 1 : 0; // Defina o valor corretamente
        $client->update($data);

        return redirect()->route('clients.index')->with('success', 'Cliente atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        if ($client->sales()->exists()) {
            $client->update(['situacao' => 0]);
            return redirect()->route('clients.index')->with('success', 'Cliente inativado com sucesso!');
        } else {
            $client->delete();
            return redirect()->route('clients.index')->with('success', 'Cliente removido com sucesso!');
        }
    }
}