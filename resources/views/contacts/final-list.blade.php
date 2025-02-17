<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Lista de Invitados Final</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>#</th>  
                    <th>Nombre</th>
                    <th>Teléfono</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($guests as $index => $guest)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $guest->name }}</td>
                        <td>{{ $guest->phone }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('generate.invitations') }}" class="btn btn-primary">Generar Invitaciones en PDF</a>

    </div>
</body>
</html>
