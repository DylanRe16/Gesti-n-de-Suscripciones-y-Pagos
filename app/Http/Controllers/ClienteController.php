<?php

namespace App\Http\Controllers;

use App\Models\Cliente; // No olvides importar el modelo
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

    public function store(Request $request)
    {
        // 1. Validar los datos
        $request->validate([
            'nombre_completo' => 'required|min:3',
            'id_fiscal' => 'required|unique:clientes',
            'email' => 'required|email|unique:clientes',
            'telefono' => 'nullable',
        ]);

        // 2. Guardar en la base de datos
        Cliente::create($request->all());

        // 3. Redireccionar con un mensaje de éxito
        return redirect()->route('clientes.index')->with('info', 'Cliente creado con éxito');
    }
}
