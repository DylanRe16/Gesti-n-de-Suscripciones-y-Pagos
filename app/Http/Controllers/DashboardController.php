<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Suscripcion;
use App\Models\Factura;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Estadísticas rápidas
        $totalClientes = Cliente::where('activo', true)->count();
        $suscripcionesActivas = Suscripcion::where('estado', 'activa')->count();
        $dineroPendiente = Factura::where('estado_pago', 'pendiente')->sum('monto');
        $totalRecaudado = Factura::where('estado_pago', 'pagada')->sum('monto');

        return view('dashboard', compact(
            'totalClientes',
            'suscripcionesActivas',
            'dineroPendiente',
            'totalRecaudado'
        ));
    }
}
