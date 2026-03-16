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
        'pagodo_el',
        'usuario_pago'
    ];
    public function suscripcion()
    {
        return $this->belongsTo(Suscripcion::class, 'suscripcion_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function operador()
    {
        // 'usuario_pago' es el nombre de la columna en tu tabla 'facturas'
        return $this->belongsTo(User::class, 'usuario_pago')
            ->withDefault([
                'name' => 'Sistema' // Esto evita el error de "property on null"
            ]);
    }
}
