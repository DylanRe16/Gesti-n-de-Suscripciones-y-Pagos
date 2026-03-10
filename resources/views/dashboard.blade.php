@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Resumen del Sistema</h1>
@stop

@section('content')
<div class="row">
    {{-- Caja: Clientes --}}
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $totalClientes }}</h3>
                <p>Clientes Activos</p>
            </div>
            <div class="icon"><i class="fas fa-users"></i></div>
            <a href="{{ route('clientes.index') }}" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    {{-- Caja: Suscripciones --}}
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $suscripcionesActivas }}</h3>
                <p>Suscripciones</p>
            </div>
            <div class="icon"><i class="fas fa-file-contract"></i></div>
            <a href="{{ route('suscripciones.index') }}" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    {{-- Caja: Dinero Pendiente --}}
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>${{ number_format($dineroPendiente, 2) }}</h3>
                <p>Por Cobrar</p>
            </div>
            <div class="icon"><i class="fas fa-money-bill-wave"></i></div>
            <a href="{{ route('facturas.index') }}" class="small-box-footer">Ver facturas <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    {{-- Caja: Recaudado --}}
    <div class="col-lg-3 col-6">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>${{ number_format($totalRecaudado, 2) }}</h3>
                <p>Recaudado</p>
            </div>
            <div class="icon"><i class="fas fa-cash-register"></i></div>
            <a href="#" class="small-box-footer">Reportes <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
@stop