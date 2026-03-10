<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    //
    protected $table = 'planes'; // <-- Añade esto
    protected $fillable = ['nombre_plan', 'descripcion', 'precio', 'meses'];
    public function suscripciones()
    {
        return $this->hasMany(Suscripcion::class, 'plan_id');
    }
}
