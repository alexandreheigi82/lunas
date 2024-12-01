<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Sale;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Package::query();

        // Filtros de Categoria e Tipo
        if ($request->has('categoria') && $request->categoria != '') {
            $query->where('categoria', $request->categoria);
        }
        if ($request->has('tipo') && $request->tipo != '' && $request->tipo != 'Todos') {
            $query->where('tipo', $request->tipo);
        }

        $packages = $query->where('situacao', true)->get(); // Apenas pacotes ativos
        return view('home', ['packages' => $packages]);
    }


    public function dashboard(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login.form');
        }

        $query = Package::query();

        if ($request->has('tipo') && $request->tipo != '' && $request->tipo != 'Todos') {
            $query->where('tipo', $request->tipo);
        }

        $packages = $query->where('situacao', true)->get(); // Apenas pacotes ativos
        $sales = Sale::with(['client', 'package', 'user'])->get();
        return view('dashboard', compact('sales', 'packages'));
    }
}
