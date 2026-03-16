<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;

class PlanController extends Controller
{

    public function index()
    {
        // Traemos todos los planes de la base de datos
        $planes = Plan::all();

        // Retornamos la vista pasándole los planes
        return view('planes.index', compact('planes'));
    } //
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric',

            'descripcion' => 'required|string',
        ]);

        $plan = new Plan();
        $plan->nombre_plan = $request->input('nombre');
        $plan->descripcion = $request->input('descripcion');
        $plan->precio = $request->input('precio');

        $plan->save();
        return redirect()->back()->with('success', 'Plan creado con exito');
    }
}
