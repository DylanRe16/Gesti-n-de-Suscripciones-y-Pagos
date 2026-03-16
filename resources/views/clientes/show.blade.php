@extends('adminlte::page')

@section('title', 'Perfil del Cliente')

@section('content_header')
<h1>
    {{ request('q') ? 'Resultados para: "'.request('q').'"' : 'Listado de Clientes' }}
</h1>
@stop
@section('content')
<div class="row">
    {{-- Columna Izquierda: Datos Básicos --}}
    <div class="col-md-3">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="https://ui-avatars.com/api/?name={{ urlencode($cliente->nombre_completo) }}" alt="User profile picture">
                </div>
                <h3 class="profile-username text-center">{{ $cliente->nombre_completo }}</h3>
                <p class="text-muted text-center">{{ $cliente->documento }}</p>
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Estado</b> <a class="float-right"><span class="badge badge-{{ $cliente->activo ? 'success' : 'danger' }}">{{ $cliente->activo ? 'Activo' : 'Inactivo' }}</span></a>
                    </li>
                    <li class="list-group-item">
                        <b>Email</b> <a class="float-right">{{ $cliente->email }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Columna Derecha: Historial --}}
    <div class="col-md-9">
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#suscripciones" data-toggle="tab">Suscripciones</a></li>
                    <li class="nav-item"><a class="nav-link" href="#facturas" data-toggle="tab">Historial de Pagos</a></li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    {{-- Tab Suscripciones --}}
                    <div class="active tab-pane" id="suscripciones">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Plan</th>
                                    <th>Inicio</th>
                                    <th>Vencimiento</th>
                                    <th>Estado</th>
                                    <th>Operador</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cliente->suscripciones as $sub)
                                <tr>
                                    <td>{{ $sub->plan->nombre_plan }}</td>
                                    <td>{{ $sub->fecha_inicio }}</td>
                                    <td>{{ $sub->fecha_fin }}</td>
                                    <td><span class="badge badge-info {{ $sub->estado == 'activa' ? 'bg-success' : 'bg-warning' }}">{{ $sub->estado }}</span></td>
                                    <td>{{ $sub->user->name }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Tab Facturas --}}
                    <div class="tab-pane" id="facturas">
                        <table class="table datatable"> {{-- Reutilizamos tu datatable --}}
                            <thead>
                                <tr>
                                    <th>Nro</th>
                                    <th>Monto</th>
                                    <th>Estado</th>
                                    <th>Marca de Pago</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cliente->suscripciones as $sub)
                                @foreach($sub->facturas as $fac)
                                <tr>
                                    <td>{{ $fac->nro_factura }}</td>
                                    <td>${{ $fac->monto }}</td>
                                    <td><span class="badge badge-{{ $fac->estado_pago == 'pagada' ? 'success' : 'warning' }}">{{ $fac->estado_pago }}</span></td>
                                    <td>fecha de pago: {{ \Carbon\Carbon::parse($fac->pagado_el)->format('d/m/Y') }}<br> Usuario: {{ $fac->operador->name }} </td>
                                </tr>
                                @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop