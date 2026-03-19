@extends('adminlte::page')
@include('layouts.extensiones')
@section('title', 'Facturación')

@section('content_header')
<h1>Historial de Facturación</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body p-4">
        <table id="tabla-general" class="table table-bordered table-striped datatable">
            <thead>
                <tr>
                    <th>Nro. Factura</th>
                    <th>Cliente</th>
                    <th>Monto</th>
                    <th>Emisión</th>
                    <th>Vencimiento</th>
                    <th>Estado</th>
                    <th>Acción</th>
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
                        <form action="{{ route('facturas.pagar', $factura) }}" method="POST" id="form-pagar-{{ $factura->id }}">
                            @csrf
                            @method('PATCH')

                            {{-- Cambiamos type="submit" por type="button" y añadimos el onclick --}}
                            <button type="button" class="btn btn-sm btn-success" onclick="confirmarPago({{ $factura->id }})">
                                <i class="fas fa-check"></i> Marcar Pago
                            </button>
                        </form>
                        @else
                        <small class="text-success"><i class="fas fa-check-double"></i> Pagado el {{ \Carbon\Carbon::parse($factura->pagado_el)->format('d/m/Y') }}</small>
                        <a href="{{ route('facturas.pdf', $factura) }}" class="btn btn-sm btn-danger">
                            <i class="fas fa-file-pdf"></i> PDF
                        </a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        // Inicializar DataTable
        $('#tabla-clientes').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
            }
        });

        // Lógica del botón de pago

    });
</script>

@stop