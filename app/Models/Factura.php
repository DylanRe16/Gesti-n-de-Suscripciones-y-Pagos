<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    //
    protected $table = 'facturas'; // <-- Añade esto
    protected $fillable = [
        'suscripcion_id',
        'nro_factura',
        'monto',
        'fecha_emision',
        'fecha_limite',
        'estado_pago',
        'pagodo_el'
    ];
    public function suscripcion()
    {
        return $this->belongsTo(Suscripcion::class, 'suscripcion_id');
    }
}
