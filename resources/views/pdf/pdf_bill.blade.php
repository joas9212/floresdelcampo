<!DOCTYPE html>
<html>
<head>
    <title>PDF</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 13px;
        }
        h1 {
            text-align: center;
            color: #4CAF50;
            margin-bottom: 20px;
        }
        .container {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
        }
        .field {
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }
        .field label {
            font-weight: bold;
            margin-right: 10px;
            min-width: 150px; /* Ajusta este valor según sea necesario */
        }
        .footer {
            width: 100%;
            text-align: center;
            position: fixed;
            bottom: 0;
        }
        .content {
            margin-top: 5px;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="content">
        @foreach($data as $item)
            <div class="container">
                <h2>Pedido {{ $item->id }}</h2>
                <div class="field">
                    <label>Fecha de entrega:</label>
                    <span>{{ $item->fecha_envio }}</span>
                </div>
                <div class="field">
                    <label>Medio de pago:</label>
                    <span>{{ $item->venta->metodo_pago->nombre }}</span>
                </div>
                <div class="field">
                    <label>Ciudad ID:</label>
                    <span>{{ $item->ciudad->nombre }}</span>
                </div>
                <div class="field">
                    <label>Dirección de entrega:</label>
                    <span>{{ $item->direccion_destionatario }}</span>
                </div>
                <div class="field">
                    <label>Recibe:</label>
                    <span>{{ $item->nombre_destinatario }}</span>
                </div>
                <div class="field">
                    <label>Contacto de quien Recibe:</label>
                    <span>{{ $item->numero_contacto_destinatario }}</span>
                </div>
                <div class="field">
                    <label>Vendedor:</label>
                    <span>{{ $item->venta->user->name }}</span>
                </div>
                <div class="field">
                    <label>Valor productos:</label>
                    <span>{{ $item->venta->valor_total }}</span>
                </div>
                <div class="field">
                    <label>Costo Envío:</label>
                    <span>{{ $item->costo_envio }}</span>
                </div>
                <div class="field">
                    <label>Total:</label>
                    <span>{{ $item->costo_envio + $item->venta->valor_total }}</span>
                </div>
                <div class="field">
                    <label>Cliente:</label>
                    <span>{{ $item->venta->cliente->nombre }}</span>
                </div>
                <div class="field">
                    <label>Contacto con cliente:</label>
                    <span>{{ $item->venta->cliente->telefono }}</span>
                </div>
                <div class="field">
                    <label>Mensaje Dedicatoria:</label>
                    <span>{{ $item->mensaje_dedicatoria }}</span>
                </div>
                <div class="field">
                    <label>Observaciones:</label>
                    <span>{{ $item->observaciones }}</span>
                </div>
                <div class="field" style="text-align: center; margin-top:40px !important">
                    <img src="file:///Proyectos/De websimaker/Floresdelcultivo/Repositorio/floresdelcampo/public/storage/{{ $item->venta->producto->imagenes[0]->ruta }}" style="max-width: 150px; max-height: 150px;">
                </div>                
            </div>
        @endforeach
    </div>
</body>
</html>
