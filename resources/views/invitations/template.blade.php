<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invitaciones</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        .invitation {
            border: 2px solid #000;
            padding: 20px;
            margin-bottom: 20px;
            width: 80%;
            margin: auto;
        }
        h2 { color: #007BFF; }
    </style>
</head>
<body>
    @foreach ($guests as $guest)
        <div class="invitation">
            <h2>¡Estás Invitado!</h2>
            <p>Estimado <strong>{{ $guest->name }}</strong>,</p>
            <p>Te esperamos en nuestra celebración especial.</p>
            <p>Fecha: <strong>DD/MM/AAAA</strong></p>
            <p>Hora: <strong>XX:XX</strong></p>
            <p>Lugar: <strong>Nombre del lugar</strong></p>
        </div>
        <div style="page-break-after: always;"></div> {{-- Esto separa cada invitación en una página diferente en el PDF --}}
    @endforeach
</body>
</html>
