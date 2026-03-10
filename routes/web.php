<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\SuscripcionController;
use App\Http\Controllers\DashboardController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/home', [DashboardController::class, 'index']); // Para compatibilidad con AdminLTE

Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
// Ruta para ver el formulario
Route::get('/clientes/crear', [ClienteController::class, 'create'])->name('clientes.create');

// Ruta para guardar los datos
Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');

Route::get('/suscripciones/crear', [SuscripcionController::class, 'create'])->name('suscripciones.create');
Route::post('/suscripciones', [SuscripcionController::class, 'store'])->name('suscripciones.store');
Route::get('/suscripciones', [SuscripcionController::class, 'index'])->name('suscripciones.index');

Route::get('/facturas', function () {
    $facturas = \App\Models\Factura::with('suscripcion.cliente')->get();
    return view('facturas.index', compact('facturas'));
})->name('facturas.index');
// Ruta para marcar la factura como pagada
Route::patch('/facturas/{factura}/pagar', [App\Http\Controllers\FacturaController::class, 'pagar'])->name('facturas.pagar');
