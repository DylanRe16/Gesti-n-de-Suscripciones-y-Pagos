@extends('adminlte::page')

@section('title', 'Planes de Servicio')

@section('content_header')
<div class="row">
    <div class="col-sm-6">
        <h1>Catálogo de Planes</h1>
    </div>
    <div class="col-sm-6 text-right">
        {{-- Botón que abre el Modal --}}
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalCrearPlan">
            <i class="fas fa-plus-circle"></i> Agregar Nuevo Plan
        </button>
    </div>
</div>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        @forelse($planes as $plan)
        <div class="col-md-4">
            <div class="card card-outline card-primary shadow-sm">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">{{ $plan->nombre_plan }}</h3>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <h2 class="text-success font-weight-bold">${{ number_format($plan->precio, 2) }}</h2>
                        <span class="text-muted">Duración: {{ $plan->duracion_meses }} mes(es)</span>
                    </div>
                    <p class="text-secondary small">{{ $plan->descripcion ?? 'Sin descripción disponible.' }}</p>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <a href="#" class="btn btn-sm btn-info">
                        <i class="fas fa-edit"></i> Editar
                    </a>
                    <form action="{{ route('planes.destroy', $plan) }}" method="POST">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> Aún no has creado planes de servicio.
            </div>
        </div>
        @endforelse
    </div>
</div>

{{-- INCLUIMOS EL MODAL DE CREACIÓN --}}
@include('planes.modal_crear')

@stop
@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if(session('info'))
        Swal.fire({
            icon: 'success',
            title: '¡Operación exitosa!',
            text: '{{ session("info") }}',
            timer: 3000,
            showConfirmButton: false,
            toast: true,
            position: 'top-end',
            timerProgressBar: true
        });
        @endif
        @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: '¡Error!',
            text: '{{ session("error") }}',
            timer: 3000,
            showConfirmButton: false,
            toast: true,
            position: 'top-end',
            timerProgressBar: true
        })
        @endif
    });
</script>
@stop