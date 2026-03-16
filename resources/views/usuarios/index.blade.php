@extends('adminlte::page')
@include('layouts.extensiones')

@section('title', 'Gestión de Usuarios')

@section('content_header')
<div class="d-flex justify-content-between">
    <h1>Usuarios del Sistema</h1>
    <button class="btn btn-primary" data-toggle="modal" data-target="#modalCrearUsuario">
        <i class="fas fa-user-plus"></i> Nuevo Usuario
    </button>
</div>
@stop
@if(session('info'))
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

    });
</script>
@stop
@endif
@if(session('error'))
@section('js')<script>
    document.addEventListener('DOMContentLoaded', function() {

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
@endif
@section('content')
<div class="card">
    <div class="card-body">
        <table id="tabla-general" class="table table-bordered table-striped datatable">
            <thead>
                <tr>
                    <th>Cedula</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $user)
                <tr style="{{ !$user->estado ? 'opacity: 0.5; background-color: #f8d7da;' : '' }}">
                    <td>{{ $user->cedula }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        @if($user->estado)
                        <span class="badge badge-success">Activo</span>
                        @else
                        <span class="badge badge-secondary">Inactivo</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('usuarios.destroy', $user) }}" method="POST">
                            @csrf @method('DELETE')
                            @if($user->estado)
                            <button class="btn btn-sm btn-danger" title="Inhabilitar">
                                <i class="fas fa-user-slash"></i>
                            </button>
                            @else
                            <button class="btn btn-sm btn-success" title="Habilitar">
                                <i class="fas fa-user-check"></i>
                            </button>
                            @endif
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('usuarios.modal_crear')
@stop