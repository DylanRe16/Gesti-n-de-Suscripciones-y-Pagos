@extends('adminlte::page')

@section('title', 'Lista de Clientes')

@section('content_header')
<h1>Gestión de Clientes</h1>

@stop
@extends('layouts.extensiones')
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
                    <td>
                        @if($cliente->activo)
                        <span class="badge badge-success">Activo</span>
                        @else
                        <span class="badge badge-danger">Inactivo</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('clientes.show', $cliente->id) }}" class="btn btn-sm btn-info">
                            <i class="fas fa-eye"></i> Perfil
                        </a>
                        <button class="btn btn-warning btn-sm">Editar</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@include('clientes.modal_crear')
@include('suscripciones.modal_crear')
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