@extends('adminlte::page')

@section('title', 'Facturación')

@section('content_header')
<h1>Historial de Facturación</h1>
@stop

@section('content')
@if(session('info'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('info') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<div class="card">
    <div class="card-body p-0">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nro. Factura</th>
                    <th>Cliente</th>
                    <th>Monto</th>
                    <th>Emisión</th>
                    <th>Vencimiento</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($facturas as $factura)
                <tr>
                    <td><strong>{{ $factura->nro_factura }}</strong></td>
                    <td>{{ $factura->suscripcion->cliente->nombre_completo }}</td>
                    <td>${{ number_format($factura->monto, 2) }}</td>
                    <td>{{ $factura->fecha_emision }}</td>
                    <td class="{{ now()->gt($factura->fecha_limite) && $factura->estado_pago != 'pagada' ? 'text-danger font-weight-bold' : '' }}">
                        {{ $factura->fecha_limite }}
                    </td>
                    <td>
                        <span class="badge badge-{{ $factura->estado_pago == 'pagada' ? 'success' : ($factura->estado_pago == 'mora' ? 'danger' : 'warning') }}">
                            {{ strtoupper($factura->estado_pago) }}
                        </span>
                    </td>
                    <td>
                        {{-- Solo mostramos el botón si la factura NO está pagada --}}
                        @if($factura->estado_pago != 'pagada')
                        <form action="{{ route('facturas.pagar', $factura) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('¿Confirmar pago de esta factura?')">
                                <i class="fas fa-check"></i> Marcar Pago
                            </button>
                        </form>
                        @else
                        <small class="text-success"><i class="fas fa-check-double"></i> Pagado el {{ \Carbon\Carbon::parse($factura->pagado_el)->format('d/m/Y') }}</small>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection