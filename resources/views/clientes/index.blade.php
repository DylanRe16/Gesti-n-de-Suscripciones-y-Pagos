@extends('adminlte::page')

@section('title', 'Lista de Clientes')

@section('content_header')
<h1>Gestión de Clientes</h1>
@stop
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Clientes Registrados</h3>
        <div class="card-tools">
            <a href="{{ route('clientes.create') }}" class="btn btn-primary btn-sm">Nuevo Cliente</a>
        </div>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>ID Fiscal</th>
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
                    <td>{{ $cliente->id_fiscal }}</td>
                    <td>{{ $cliente->email }}</td>
                    <td>
                        @if($cliente->activo)
                        <span class="badge badge-success">Activo</span>
                        @else
                        <span class="badge badge-danger">Inactivo</span>
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-info btn-sm">Ver</button>
                        <button class="btn btn-warning btn-sm">Editar</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop

@section('css')
{{-- Aquí puedes poner CSS extra si quieres --}}
@stop

@section('js')
<script>
    console.log('¡AdminLTE cargado!');
</script>
@stop