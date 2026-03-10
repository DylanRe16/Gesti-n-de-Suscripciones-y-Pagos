<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Plan;
use App\Models\Cliente;
use Illuminate\Database\Seeder;

class SistemaDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Crear Planes
        Plan::create([
            'nombre_plan' => 'Plan Básico',
            'descripcion' => 'Acceso limitado para emprendedores',
            'precio' => 29.99,
            'meses' => 1
        ]);

        Plan::create([
            'nombre_plan' => 'Plan Empresarial',
            'descripcion' => 'Acceso total y soporte 24/7',
            'precio' => 299.00,
            'meses' => 12
        ]);

        // 2. Crear un Cliente de prueba
        Cliente::create([
            'nombre_completo' => 'Dylan Industries',
            'id_fiscal' => 'J-12345678-0',
            'email' => 'contacto@dylan.com',
            'telefono' => '555-0199',
            'activo' => true
        ]);
    }
}
