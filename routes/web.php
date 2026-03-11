<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\SuscripcionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

Auth::routes();
Route::get('/', function () {
    return redirect('/login');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/home', [DashboardController::class, 'index']); // Para compatibilidad con AdminLTE

    Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
    // Ruta para ver el formulario
    Route::get('/clientes/crear', [ClienteController::class, 'create'])->name('clientes.create');

    // Ruta para guardar los datos
    Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');
    Route::get('/clientes/{cliente}', [ClienteController::class, 'show'])->name('clientes.show');
    Route::get('/buscar-cliente', [ClienteController::class, 'buscar'])->name('clientes.buscar');

    Route::get('/suscripciones/crear', [SuscripcionController::class, 'create'])->name('suscripciones.create');
    Route::post('/suscripciones', [SuscripcionController::class, 'store'])->name('suscripciones.store');
    Route::get('/suscripciones', [SuscripcionController::class, 'index'])->name('suscripciones.index');

    Route::get('/facturas/historial', function () {
        $facturas = \App\Models\Factura::with('suscripcion.cliente')->get();
        return view('facturas.index', compact('facturas'));
    })->name('facturas.index');
    // Ruta para marcar la factura como pagada
    Route::patch('/facturas/{factura}/pagar', [App\Http\Controllers\FacturaController::class, 'pagar'])->name('facturas.pagar');
    Route::get('/facturas/{factura}/pdf', [FacturaController::class, 'descargar'])->name('facturas.pdf');

    //   Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::group(['middleware' => ['role:Admin']], function () {
        Route::delete('/clientes/{id}', [ClienteController::class, 'destroy']);
        Route::resource('planes', PlanController::class);
    });
    Route::resource('usuarios', UserController::class);
    Route::post('/usuario', [UserController::class, 'store'])->name('usuarios.store');
    Route::group(['middleware' => ['role:Vendedor']], function () {});
});
