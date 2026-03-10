<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use Illuminate\Http\Request;

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
}
