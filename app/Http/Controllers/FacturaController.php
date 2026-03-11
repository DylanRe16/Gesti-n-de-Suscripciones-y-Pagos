<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; // Importar la librería arriba

class FacturaController extends Controller
{
    public function pagar(Factura $factura)
    {
        // Actualizamos el estado y la fecha de pago
        $factura->update([
            'estado_pago' => 'pagada',
            'pagado_el' => now()
        ]);

        return redirect()->back()->with('info', '¡Pago registrado con éxito!');
    }
    public function descargar(Factura $factura)
    {
        // Cargamos la relación para tener los datos del cliente y el plan
        $factura->load('suscripcion.cliente', 'suscripcion.plan');

        // Cargamos una vista especial para el PDF y le pasamos la factura
        $pdf = Pdf::loadView('facturas.pdf', compact('factura'));

        // Retornamos el PDF para que se descargue con el nombre de la factura
        return $pdf->download($factura->nro_factura . '.pdf');
    }
}
