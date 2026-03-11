<!DOCTYPE html>
<html>

<head>
    <title>Factura {{ $factura->nro_factura }}</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 14px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .datos-cliente {
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }

        .tabla {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .tabla th {
            background-color: #f2f2f2;
            padding: 10px;
            text-align: left;
        }

        .tabla td {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        .total {
            text-align: right;
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 10px;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>FACTURA ELECTRÓNICA</h1>
        <p><strong>Nro:</strong> {{ $factura->nro_factura }}</p>
    </div>

    <div class="datos-cliente">
        <p><strong>Cliente:</strong> {{ $factura->suscripcion->cliente->nombre_completo }}</p>
        <p><strong>ID Fiscal:</strong> {{ $factura->suscripcion->cliente->id_fiscal }}</p>
        <p><strong>Email:</strong> {{ $factura->suscripcion->cliente->email }}</p>
        <p><strong>Fecha Emisión:</strong> {{ $factura->fecha_emision }}</p>
    </div>

    <table class="tabla">
        <thead>
            <tr>
                <th>Descripción</th>
                <th>Cant.</th>
                <th>Precio</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Suscripción al {{ $factura->suscripcion->plan->nombre_plan }}</td>
                <td>1</td>
                <td>${{ number_format($factura->monto, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <div class="total">
        TOTAL A PAGAR: ${{ number_format($factura->monto, 2) }}
    </div>

    <div class="footer">
        Generado automáticamente por Sistema Suscripciones - {{ date('Y') }}
    </div>
</body>

</html>