@extends('adminlte::page')

@section('title', 'Nueva Suscripción')

@section('content_header')
<h1>Activar Nueva Suscripción</h1>
@stop

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Asignación de Plan</h3>
    </div>

    <form action="{{ route('suscripciones.store') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="row">
                {{-- Columna 1: Cliente y Plan --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cliente_id">Seleccionar Cliente</label>
                        <select name="cliente_id" class="form-control" required>
                            <option value="">-- Seleccione un cliente --</option>
                            @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->nombre_completo }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="plan_id">Plan a Contratar</label>
                        <select name="plan_id" class="form-control" required>
                            <option value="">-- Seleccione un plan --</option>
                            @foreach($planes as $plan)
                            <option value="{{ $plan->id }}">{{ $plan->nombre_plan }} (${{ $plan->precio }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Columna 2: Fechas --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Fecha de Inicio</label>
                        <input type="date" name="fecha_inicio" class="form-control" value="{{ date('Y-m-d') }}" required>
                        <small class="text-muted">La fecha de vencimiento se calculará automáticamente según los meses del plan.</small>
                    </div>

                    <div class="alert alert-info mt-4">
                        <h5><i class="icon fas fa-info"></i> Nota Importante</h5>
                        Al guardar, el sistema generará el registro de suscripción y calculará el monto fijo basado en el precio actual del plan.
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-success">Activar Suscripción Ahora</button>
            <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </form>
</div>
@stop