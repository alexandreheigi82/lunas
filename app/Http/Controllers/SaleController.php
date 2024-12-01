<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Client;
use App\Models\Package;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    public function create()
    {
        $clients = Client::all();
        $packages = Package::where('situacao', 1)->get(); // Filtrar pacotes ativos
        return view('sales.create', compact('clients', 'packages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'package_id' => 'required|exists:packages,id',
            'quantidade' => 'required|integer|min:1',
        ]);

        

        $package = Package::findOrFail($request->package_id);

        // Verifique se o pacote está ativo
        if ($package->situacao != 1) {
            return redirect()->back()->withErrors(['package_id' => 'Este pacote não está disponível para venda.']);
        }

        $quantidade_vagas_disponiveis = $package->vagas - $request->quantidade;

        if ($quantidade_vagas_disponiveis < 0) {
            return back()->withErrors(['quantidade' => 'Quantidade excede o número de vagas disponíveis']);
        }

        // Atualizar a quantidade de vagas disponíveis no pacote
        $package->update(['vagas' => $quantidade_vagas_disponiveis]);

        Sale::create([
            'client_id' => $request->client_id,
            'user_id' => Auth::id(),
            'package_id' => $request->package_id,
            'quantidade' => $request->quantidade,
        ]);

        return redirect()->route('sales.index')->with('success', 'Venda realizada com sucesso!'); // Redirecionar para a lista de vendas
    }

    public function index(Request $request)
    {
        $search = $request->input('search');

        $sales = Sale::query()
            ->whereHas('client', function ($query) use ($search) {
                $query->where('nome', 'LIKE', "%{$search}%")
                      ->orWhere('sobrenome', 'LIKE', "%{$search}%");
            })
            ->orWhereHas('package', function ($query) use ($search) {
                $query->where('titulo', 'LIKE', "%{$search}%");
            })
            ->get();

        return view('sales.index', compact('sales'));
    }

    public function show($id)
    {
        $sale = Sale::with(['client', 'package', 'user'])->findOrFail($id);
        return view('sales.show', compact('sale'));
    }

    public function edit($id)
    {
        $sale = Sale::findOrFail($id);
        $clients = Client::all();
        $packages = Package::where('situacao', 1)->get(); // Apenas pacotes ativos
        return view('sales.edit', compact('sale', 'clients', 'packages'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'package_id' => 'required|exists:packages,id',
            'quantidade' => 'required|integer|min:1',
        ]);

        $sale = Sale::findOrFail($id);
        $package = Package::findOrFail($request->package_id);

        // Verifique se o pacote está ativo
        if ($package->situacao != 1) {
            return redirect()->back()->withErrors(['package_id' => 'Este pacote não está disponível para venda.']);
        }

        // Restaurar vagas anteriores
        $quantidade_vagas_disponiveis = $package->vagas + $sale->quantidade;

        // Subtrair vagas conforme a nova quantidade
        $quantidade_vagas_disponiveis -= $request->quantidade;

        if ($quantidade_vagas_disponiveis < 0) {
            return back()->withErrors(['quantidade' => 'Quantidade excede o número de vagas disponíveis']);
        }

        // Atualizar a quantidade de vagas disponíveis no pacote
        $package->update(['vagas' => $quantidade_vagas_disponiveis]);

        $sale->update([
            'client_id' => $request->client_id,
            'package_id' => $request->package_id,
            'quantidade' => $request->quantidade,
        ]);

        return redirect()->route('sales.show', $sale->id)->with('success', 'Venda atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $sale = Sale::findOrFail($id);
        $package = $sale->package;

        // Atualizar quantidade de vagas no pacote
        $package->update(['vagas' => $package->vagas + $sale->quantidade]);

        $sale->delete();

        return redirect()->route('dashboard')->with('success', 'Venda excluída com sucesso!');
    }
}
