<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    //
    protected $table = 'clientes'; // <-- Añade esto
    protected $fillable = ['nombre_completo', 'id_fiscal', 'email', 'telefono', 'activo'];
    public function suscripciones()
    {
        return $this->hasMany(Suscripcion::class, 'cliente_id');
    }
}
