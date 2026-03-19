@extends('adminlte::page')
@extends('layouts.extensiones')
@section('title', 'Lista de Clientes')

@section('content_header')
<h1>Gestión de Clientes</h1>

@stop
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Clientes Registrados</h3>
        <div class="card-tools"> <button class="btn btn-primary" data-toggle="modal" data-target="#modalCrear2">
                <i class="fas fa-plus-circle"></i> Nueva Suscripción
            </button>
            <button class="btn btn-success" data-toggle="modal" data-target="#modalCrear">
                <i class="fas fa-plus"></i> Nuevo Cliente
            </button>
        </div>
    </div>
    <div class="card-body p-4">
        <table id="tabla-general" class="table table-bordered table-striped datatable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Nro. Documento</th>
                    <th>Email</th>
                    <th>Estado</th>
                    <th style="width: 150px">Acciones</th>
                </tr>
            </thead>
            <tbody>

                @foreach($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->id }}</td>
                    <td>{{ $cliente->nombre_completo }}</td>
                    <td>{{ $cliente->documento }}</td>
                    <td>{{ $cliente->email }}</td>
                    <td class="text-center">
                        @if($cliente->activo)
                        <span class="badge badge-success">Activo</span>
                        @else
                        <span class="badge badge-danger">Inactivo</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('clientes.show', $cliente->id) }}" class="btn btn-sm btn-info">
                            <i class="fas fa-eye"></i> Perfil
                        </a>
                        <!-- <button class="btn btn-warning btn-sm">Editar</button> -->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // 1. Función GLOBAL para confirmar el pago
    window.confirmarPago = function(facturaId) {
        Swal.fire({
            title: '¿Confirmar pago?',
            text: "Esta acción marcará la factura como pagada.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, pagar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                var formulario = document.getElementById('form-pagar-' + facturaId);
                if (formulario) {
                    formulario.submit();
                }
            }
        });
    }

    // 2. Detector de mensajes de éxito (Se ejecuta al cargar la página)
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
    });
</script>
@include('clientes.modal_crear')
@include('suscripciones.modal_crear')
@endsection

@section('js')
<script>
    $(document).ready(function() {
        // Inicializar DataTable
        $('#tabla-general').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
            }
        });

        // Lógica del botón de pago

    });
</script>

@stop