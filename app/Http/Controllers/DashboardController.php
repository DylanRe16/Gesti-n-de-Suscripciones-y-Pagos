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

        $dineroPendiente = Factura::where('estado_pago', 'pendiente')->sum('monto');
        $totalRecaudado = Factura::where('estado_pago', 'pagada')->sum('monto');
        $totalClientes = \App\Models\Cliente::count();
        $suscripcionesActivas = \App\Models\Suscripcion::where('estado', 'activa')->count();

        // Datos para la gráfica
        $pagado = \App\Models\Factura::where('estado_pago', 'pagada')->sum('monto');
        $pendiente = \App\Models\Factura::where('estado_pago', 'pendiente')->sum('monto');
        $mora = \App\Models\Factura::where('estado_pago', 'mora')->sum('monto');

        return view('dashboard', compact(
            'totalClientes',
            'suscripcionesActivas',
            'dineroPendiente',
            'totalRecaudado',
            'pagado',
            'pendiente',
            'mora'
        ));
    }
}
