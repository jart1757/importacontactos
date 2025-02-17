<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Editar Lista de Invitados</h2>

        <form action="{{ route('contacts.final') }}" method="POST">
            @csrf
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>  
                        <th>Nombre</th>
                        <th>Teléfono</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($selectedContacts as $index => $contact)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <input type="text" name="contacts[{{ $contact->id }}][name]" 
                                       value="{{ $contact->name }}" class="form-control">
                            </td>
                            <td>{{ $contact->phone }}</td>
                            <input type="hidden" name="contacts[{{ $contact->id }}][phone]" value="{{ $contact->phone }}">
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <button type="submit" class="btn btn-success">Guardar Cambios y Enviar a Lista Final</button>
        </form>
    </div>
</body>
</html>
