<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    </head>
<body>
    <div class="container mt-5">
        <h2>Contactos Importados</h2>
    
        <input type="text" id="searchInput" class="form-control mb-3" placeholder="Buscar por nombre o número">
    
        <div class="table-responsive">  <table class="table">
                <thead>
                    <tr>
                        <th>#</th>  <th>Nombre</th>
                        <th>Teléfono</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    @foreach ($contacts as $contact)
                        <tr>
                            <td></td>  <td>{{ $contact->name }}</td>
                            <td>{{ $contact->phone }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>  <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item {{ $contacts->previousPageUrl() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $contacts->previousPageUrl() ?? '#' }}" aria-label="Previous">
                        Anterior
                    </a>
                </li>
                @foreach ($contacts->getUrlRange(1, $contacts->lastPage()) as $page => $url)
                    <li class="page-item {{ $contacts->currentPage() == $page ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach
                <li class="page-item {{ $contacts->nextPageUrl() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $contacts->nextPageUrl() ?? '#' }}" aria-label="Next">
                        Siguiente
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    
    <script>
        const searchInput = document.getElementById('searchInput');
        const tableBody = document.getElementById('tableBody');
        const rows = tableBody.querySelectorAll('tr');
    
        searchInput.addEventListener('keyup', function(event) {
            const searchTerm = event.target.value.toLowerCase();
    
            rows.forEach(row => {
                const name = row.cells[1].textContent.toLowerCase(); // Índice 1 porque ahora la primera celda es para el número
                const phone = row.cells[2].textContent.toLowerCase(); // Índice 2 por la misma razón
    
                if (name.includes(searchTerm) || phone.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    
        // Numeración de filas
        rows.forEach((row, index) => {
            const numberCell = row.cells[0];
            numberCell.textContent = index + 1;
        });
    
    </script>
</body>
</html>