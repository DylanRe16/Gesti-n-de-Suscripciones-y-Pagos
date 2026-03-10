@extends('adminlte::page')

@section('title', 'Listado de Suscripciones')

@section('content_header')
<h1>Suscripciones Activas</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Control de Membresías</h3>
        <div class="card-tools">
            <a href="{{ route('suscripciones.create') }}" class="btn btn-primary btn-sm">Nueva Suscripción</a>
        </div>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Plan</th>
                    <th>Monto</th>
                    <th>Inicio</th>
                    <th>Vencimiento</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($suscripciones as $suscripcion)
                <tr>
                    <td>{{ $suscripcion->cliente->nombre_completo }}</td>
                    <td>{{ $suscripcion->plan->nombre_plan }}</td>
                    <td>${{ number_format($suscripcion->precio_fijo, 2) }}</td>
                    <td>{{ \Carbon\Carbon::parse($suscripcion->fecha_inicio)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($suscripcion->fecha_fin)->format('d/m/Y') }}</td>
                    <td>
                        @if($suscripcion->estado == 'activa')
                        <span class="badge badge-success">Activa</span>
                        @elseif($suscripcion->estado == 'vencida')
                        <span class="badge badge-danger">Vencida</span>
                        @else
                        <span class="badge badge-secondary">{{ $suscripcion->estado }}</span>
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-sm btn-default text-primary shadow-sm" title="Ver Facturas">
                            <i class="fa fa-fw fa-eye"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection