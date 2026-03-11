@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Resumen del Sistema</h1>
@stop

@section('content')
<div class="row">
    {{-- Caja: Clientes --}}
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $totalClientes }}</h3>
                <p>Clientes Activos</p>
            </div>
            <div class="icon"><i class="fas fa-users"></i></div>
            <a href="{{ route('clientes.index') }}" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    {{-- Caja: Suscripciones --}}
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $suscripcionesActivas }}</h3>
                <p>Suscripciones</p>
            </div>
            <div class="icon"><i class="fas fa-file-contract"></i></div>
            <a href="{{ route('suscripciones.index') }}" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    {{-- Caja: Dinero Pendiente --}}
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>${{ number_format($dineroPendiente, 2) }}</h3>
                <p>Por Cobrar</p>
            </div>
            <div class="icon"><i class="fas fa-money-bill-wave"></i></div>
            <a href="{{ route('facturas.index') }}" class="small-box-footer">Ver facturas <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    {{-- Caja: Recaudado --}}
    <div class="col-lg-3 col-6">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>${{ number_format($totalRecaudado, 2) }}</h3>
                <p>Recaudado</p>
            </div>
            <div class="icon"><i class="fas fa-cash-register"></i></div>
            <a href="#" class="small-box-footer">Reportes <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
<div class="row">

    <div class="col-md-4">
        {{-- Aquí podrías poner una lista de clientes recientes --}}
        <div class="info-box bg-light">
            <span class="info-box-icon"><i class="fas fa-chart-pie"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Proyección Total</span>
                <span class="info-box-number">${{ number_format($pagado + $pendiente + $mora, 2) }}</span>
            </div>
        </div>
    </div>
</div>
@stop
@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    $(document).ready(function() {
        console.log("Cargando gráfica..."); // Esto aparecerá en F12 si el script corre

        var ctx = document.getElementById('miGrafica');

        // Si el elemento no existe, nos avisará en la consola
        if (!ctx) {
            console.error("No se encontró el elemento canvas 'miGrafica'");
            return;
        }

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Pagado', 'Pendiente', 'En Mora'],
                datasets: [{
                    label: 'Monto Total ($)',
                    data: [{
                        {
                            $pagado
                        }
                    }, {
                        {
                            $pendiente
                        }
                    }, {
                        {
                            $mora
                        }
                    }],
                    backgroundColor: [
                        'rgba(40, 167, 69, 0.7)',
                        'rgba(255, 193, 7, 0.7)',
                        'rgba(220, 53, 69, 0.7)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
@stop