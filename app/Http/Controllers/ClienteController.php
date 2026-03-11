<?php

namespace App\Http\Controllers;

use App\Models\Cliente; // No olvides importar el modelo
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        // Traemos todos los clientes de Postgres
        $clientes = Cliente::all();

        // Enviamos los datos a la vista 'clientes.index'
        return view('clientes.index', compact('clientes'));
    }
    public function create()
    {
        return view('clientes.create');
    }
    public function show(Cliente $cliente)
    {
        // Cargamos las suscripciones, el plan de cada una y las facturas
        $cliente->load(['suscripciones.plan', 'suscripciones.facturas']);

        return view('clientes.show', compact('cliente'));
    }

    public function store(Request $request)
    {
        // 1. Validar los datos
        $request->validate([
            'nombre_completo' => 'required|min:3',
            'id_fiscal' => 'required|numeric',
            'email' => 'required|email',
            'telefono' => 'nullable',
        ]);
        $busqueda_cliente_existente = Cliente::where('id_fiscal', $request->id_fiscal)->first();
        if ($busqueda_cliente_existente) {
            return back()->with('error', 'El cliente ya se encuentra registrado');
        }
        $busqueda_cliente_existente = Cliente::where('email', $request->email)->first();
        if ($busqueda_cliente_existente) {
            return back()->with('error', 'El correo ya se encuentra registrado');
        }

        // 2. Guardar en la base de datos
        Cliente::create($request->all());

        // 3. Redireccionar con un mensaje de éxito
        return back()->with('info', 'Cliente registrado con éxito');
    }
    public function buscar(Request $request)
    {
        $query = $request->input('q');

        // Buscamos clientes que coincidan con el nombre o el ID Fiscal
        $clientes = Cliente::where('nombre_completo', 'ILIKE', "%{$query}%")
            ->orWhere('id_fiscal', 'ILIKE', "%{$query}%")
            ->get();

        // Si solo hay un resultado, vamos directo al show
        if ($clientes->count() === 1) {
            return redirect()->route('clientes.show', $clientes->first()->id);
        }

        // Si hay varios (o ninguno), volvemos al index con los resultados
        return view('clientes.index', compact('clientes'));
    }
}
