<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f8f0;
        margin: 0;
        padding: 20px;
    }
    .container {
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        padding: 20px 10px; /* Update: Added padding adjustment */
        width: 100%;
        max-width: 100%; /* Update: Changed max-width to 100% */
        overflow-x: auto;
        margin: 0 auto;
    }
    .search-container {
        margin-bottom: 20px;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }
    h1 {
        color: #2e7d32;
        text-align: center;
    }
    #searchInput {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border: 2px solid #4caf50;
        border-radius: 4px;
    }
    table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        margin-top: 20px;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        table-layout: fixed; /* Update: Added table-layout: fixed; */
    }
    th, td {
        border: 1px solid #ddd;
        padding: 12px 8px; /* Update: Adjusted padding */
        text-align: left;
        word-wrap: break-word; /* Update: Added word-wrap */
        overflow-wrap: break-word; /* Update: Added overflow-wrap */
    }
    th:nth-child(6), td:nth-child(6), /* Update: Added width for Description Actual */
    th:nth-child(10), td:nth-child(10) { /* Update: Added width for Attributes */
        width: 200px;
    }
    th {
        background-color: #2e7d32;
        color: white;
        cursor: pointer;
        text-transform: uppercase;
        letter-spacing: 0.03em;
    }
    th:hover {
        background-color: #45a049;
    }
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    tr:hover {
        background-color: #e8f5e9;
    }
    .button-container {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
        gap: 10px;
    }
    .btn {
        padding: 0.5rem 1rem;
        background-color: #4caf50;
        color: white;
        border: none;
        border-radius: 0.375rem;
        font-size: 0.875rem;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.3s, box-shadow 0.3s;
    }
    .btn:hover {
        background-color: #45a049;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    }
    td {
        background-color: #ffffff;
        position: relative;
    }
    td:hover::before {
        content: "";
        position: absolute;
        background-color: rgba(78, 216, 96, 0.2);
        left: 0;
        right: 0;
        top: -9999px;
        bottom: -9999px;
        z-index: -1;
    }
    .filter-container {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }
    .filter-container select {
        padding: 8px;
        border-radius: 4px;
        border: 1px solid #4caf50;
    }
    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
        align-items: center; /* Align items vertically */
    }
    .pagination button {
        margin: 0 5px;
    }
    .pagination select {
        margin: 0 5px;
    }
    @media (max-width: 1024px) { /* Update: Added media query for 1024px */
        table {
            font-size: 14px;
        }
        th, td {
            padding: 8px 4px; /* Update: Adjusted padding */
        }
    }
    @media (max-width: 768px) { /* Update: Added media query for 768px */
        .container {
            padding: 10px 5px; /* Update: Adjusted padding */
        }
        table {
            font-size: 12px;
        }
        th, td {
            padding: 6px 2px; /* Update: Adjusted padding */
        }
        th:nth-child(6), td:nth-child(6),
        th:nth-child(10), td:nth-child(10) {
            width: 150px; /* Update: Adjusted width */
        }
    }
    @media (max-width: 640px) {
        .button-container, .filter-container {
            flex-direction: column;
        }
        .btn, .filter-container select {
            width: 100%;
            margin-bottom: 0.5rem;
        }
        table {
            font-size: 0.875rem;
        }
    }
</style>
<div class="container">
    <h1>Ambientes</h1>
        <div class="button-container mb-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAmbienteModal">
                Agregar Ambiente
            </button>
        </div>
        <div class="search-container mb-3">
            <input type="text" id="searchInput" placeholder="Buscar en la lista de ambientes..." class="form-control">
        </div>
    <div class="table-container" style="overflow-x: auto;">
        <table id="ambientesTable" >
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Piso</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ambientes as $ambiente)
                <tr>
                    <td>{{ $ambiente->codigo }}</td>
                    <td>{{ $ambiente->nombre }}</td>
                    <td>{{ $ambiente->piso }}</td>
                    <td>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#updateAmbienteModal" data-id="{{ $ambiente->id }}" data-codigo="{{ $ambiente->codigo }}" data-nombre="{{ $ambiente->nombre }}" data-piso="{{ $ambiente->piso }}">
                            <i class="bi bi-pencil-fill"></i> Actualizar
                        </button>
                        <form action="{{ route('ambientes.destroy', $ambiente->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este ambiente?');">
                                <i class="bi bi-trash-fill"></i> Borrar
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="pagination">
        <button id="prevPage" class="btn">Anterior</button>
        <span id="currentPage"></span>
        <button id="nextPage" class="btn">Siguiente</button>
        <select id="recordLimit" class="btn">
            <option value="10">10 por página</option>
            <option value="25">25 por página</option>
            <option value="50">50 por página</option>
            <option value="100">100 por página</option>
        </select>
    </div>
</div>

<!-- Modal para agregar profesor -->
<div class="modal fade" id="addAmbienteModal" tabindex="-1" aria-labelledby="addAmbienteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAmbienteModalLabel">Agregar Ambiente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('ambientes.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="codigo" class="form-label">Código</label>
                        <input type="text" class="form-control" id="codigo" name="codigo" required>
                    </div>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="piso" class="form-label">Piso</label>
                        <input type="text" class="form-control" id="piso" name="piso" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar Ambiente</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal para actualizar ambiente -->
<div class="modal fade" id="updateAmbienteModal" tabindex="-1" aria-labelledby="updateAmbienteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateAmbienteModalLabel">Actualizar Ambiente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateAmbienteForm" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="updateAmbienteId" name="id">
                    <div class="mb-3">
                        <label for="updateCodigo" class="form-label">Código</label>
                        <input type="text" class="form-control" id="updateCodigo" name="codigo" required>
                    </div>
                    <div class="mb-3">
                        <label for="updateNombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="updateNombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="updatePiso" class="form-label">Piso</label>
                        <input type="text" class="form-control" id="updatePiso" name="piso" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar Ambiente</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Script para llenar el modal de actualización
    const updateModal = document.getElementById('updateAmbienteModal');
    updateModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // Botón que abrió el modal
        const id = button.getAttribute('data-id');
        const codigo = button.getAttribute('data-codigo');
        const nombre = button.getAttribute('data-nombre');
        const piso = button.getAttribute('data-piso');

        const modalTitle = updateModal.querySelector('.modal-title');
        const modalBodyInputCodigo = updateModal.querySelector('#updateCodigo');
        const modalBodyInputNombre = updateModal.querySelector('#updateNombre');
        const modalBodyInputPiso = updateModal.querySelector('#updatePiso');
        const modalBodyInputId = updateModal.querySelector('#updateAmbienteId');

        modalTitle.textContent = 'Actualizar Ambiente';
        modalBodyInputCodigo.value = codigo;
        modalBodyInputNombre.value = nombre;
        modalBodyInputPiso.value = piso;
        modalBodyInputId.value = id;

        // Cambiar la acción del formulario para actualizar el ambiente
        const form = document.getElementById('updateAmbienteForm');
        form.action = `/ambientes/${id}`; // Ajusta la ruta según tu configuración de rutas
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const table = document.getElementById('ambientesTable');
        const rows = table.getElementsByTagName('tr');
        const recordLimit = document.getElementById('recordLimit');
        const prevPageBtn = document.getElementById('prevPage');
        const nextPageBtn = document.getElementById('nextPage');
        let currentPage = 1;
        let rowsPerPage = parseInt(recordLimit.value);
        let filteredRows = Array.from(rows).slice(1); // Exclude header row

        function displayRows() {
            const totalFilteredPages = Math.ceil(filteredRows.length / rowsPerPage);
            for (let i = 1; i < rows.length; i++) {
                rows[i].style.display = 'none'; // Hide all rows
            }

            // Show only the rows for the current page
            const startIndex = (currentPage - 1) * rowsPerPage;
            const endIndex = startIndex + rowsPerPage;
            for (let i = startIndex + 1; i < endIndex + 1; i++) {
                if (filteredRows[i - 1]) {
                    filteredRows[i - 1].style.display = ''; // Show the row
                }
            }

            document.getElementById('currentPage').innerText = `Página ${currentPage} de ${totalFilteredPages}`;
            prevPageBtn.disabled = currentPage === 1;
            nextPageBtn.disabled = currentPage === totalFilteredPages;
        }

        function filterRows() {
            const filter = searchInput.value.toLowerCase();
            filteredRows = Array.from(rows).slice(1).filter(row => {
                const cells = row.getElementsByTagName('td');
                return Array.from(cells).some(cell => cell.innerText.toLowerCase().includes(filter));
            });

            // Reset current page and display rows
            currentPage = 1;
            displayRows();
        }

        searchInput.addEventListener('keyup', function() {
            filterRows();
        });

        recordLimit.addEventListener('change', function() {
            rowsPerPage = parseInt(recordLimit.value);
            currentPage = 1; // Reset to first page
            displayRows();
        });

        prevPageBtn.addEventListener('click', function() {
            if (currentPage > 1) {
                currentPage--;
                displayRows();
            }
        });

        nextPageBtn.addEventListener('click', function() {
            const totalFilteredPages = Math.ceil(filteredRows.length / rowsPerPage);
            if (currentPage < totalFilteredPages) {
                currentPage++;
                displayRows();
            }
        });

        displayRows(); // Initial display
    });
</script>

</x-app-layout>
