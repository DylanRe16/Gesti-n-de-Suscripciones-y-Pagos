<?php

namespace App\Http\Controllers;

use App\Models\Suscripcion;
use App\Models\Cliente;
use App\Models\Factura;
use App\Models\Plan;
use Illuminate\Http\Request;
use Carbon\Carbon; // Para manejar fechas

class SuscripcionController extends Controller
{
    public function index()
    {
        // Traemos las suscripciones con sus relaciones para no saturar la BD
        $suscripciones = Suscripcion::with(['cliente', 'plan'])->get();

        return view('suscripciones.index', compact('suscripciones'));
    }
    public function create()
    {
        $clientes = Cliente::where('activo', true)->get();
        $planes = Plan::all();
        return view('suscripciones.create', compact('clientes', 'planes'));
    }

    public function store(Request $request)
    {
        $plan = Plan::find($request->plan_id);
        $fecha_inicio = \Carbon\Carbon::parse($request->fecha_inicio);
        $fecha_fin = $fecha_inicio->copy()->addMonths($plan->meses);

        // 1. Crear Suscripción
        $suscripcion = Suscripcion::create([
            'cliente_id'   => $request->cliente_id,
            'plan_id'      => $request->plan_id,
            'precio_fijo'  => $plan->precio,
            'fecha_inicio' => $fecha_inicio,
            'fecha_fin'    => $fecha_fin,
            'estado'       => 'activa'
        ]);

        // 2. Generar Número de Factura único (Ejemplo: FAC-2026-001)
        // Aquí podrías usar un correlativo de la base de datos, pero por ahora usemos el timestamp
        $nro_factura = 'FAC-' . now()->format('Ymd') . '-' . str_pad(Factura::count() + 1, 4, '0', STR_PAD_LEFT);

        // 3. Crear Factura con los campos completos
        Factura::create([
            'suscripcion_id' => $suscripcion->id,
            'nro_factura'    => $nro_factura,
            'monto'          => $plan->precio,
            'fecha_emision'  => now(),
            'fecha_limite'   => now()->addDays(15), // 15 días para pagar
            'estado_pago'    => 'pendiente',
        ]);

        return redirect()->route('suscripciones.index')->with('info', 'Suscripción activa y Factura ' . $nro_factura . ' generada.');
    }
}
