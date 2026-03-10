<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suscripcion extends Model
{
    //
    protected $table = 'suscripciones'; // <-- Añade esto
    protected $fillable = [
        'cliente_id',
        'plan_id',
        'precio_fijo',
        'fecha_inicio',
        'fecha_fin',
        'estado'
    ];
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }

    public function facturas()
    {
        return $this->hasMany(Factura::class, 'suscripcion_id');
    }
}
