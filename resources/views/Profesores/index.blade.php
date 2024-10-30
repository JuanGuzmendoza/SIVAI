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
    <h1>Profesores</h1>
    <div class="button-container">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProfessorModal">
            Agregar Profesor
        </button>
    </div>
    <div class="search-container">
        <input type="text" id="searchInput" placeholder="Buscar en la lista de profesores...">
    </div>
    <div class="table-container" style="overflow-x: auto;">
        <table id="professorsTable">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Documento</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($profesores as $profesor)
                <tr>
                    <td>{{ $profesor->nombre_profesor }}</td>
                    <td>{{ $profesor->documento }}</td>
                    <td>{{ $profesor->email_profesor }}</td>
                    <td>{{ $profesor->telefono_profesor }}</td>
                    <td>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#updateProfessorModal" data-id="{{ $profesor->id }}" data-nombre="{{ $profesor->nombre_profesor }}" data-documento="{{ $profesor->documento }}" data-email="{{ $profesor->email_profesor }}" data-telefono="{{ $profesor->telefono_profesor }}">
                            <i class="bi bi-pencil-fill"></i> Actualizar
                        </button>
                        <form action="{{ route('profesores.destroy', $profesor->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este profesor?');">
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
<div class="modal fade" id="addProfessorModal" tabindex="-1" aria-labelledby="addProfessorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProfessorModalLabel">Agregar Profesor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('profesores.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nombre_profesor" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre_profesor" name="nombre_profesor" required>
                    </div>
                    <div class="mb-3">
                        <label for="documento" class="form-label">Documento</label>
                        <input type="text" class="form-control" id="documento" name="documento" required>
                    </div>
                    <div class="mb-3">
                        <label for="email_profesor" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email_profesor" name="email_profesor" required>
                    </div>
                    <div class="mb-3">
                        <label for="telefono_profesor" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="telefono_profesor" name="telefono_profesor" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar Profesor</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const table = document.getElementById('professorsTable');
        const rows = table.getElementsByTagName('tr');
        const recordLimit = document.getElementById('recordLimit');
        const prevPageBtn = document.getElementById('prevPage');
        const nextPageBtn = document.getElementById('nextPage');
        let currentPage = 1;
        let rowsPerPage = parseInt(recordLimit.value);
        let filteredRows = Array.from(rows).slice(1); // Exclude header row
        const totalPages = Math.ceil(filteredRows.length / rowsPerPage);

        function displayRows() {
            for (let i = 1; i < rows.length; i++) {
                rows[i].style.display = (Math.ceil(i / rowsPerPage) === currentPage) ? '' : 'none';
            }
            document.getElementById('currentPage').innerText = `Página ${currentPage} de ${totalPages}`;
            prevPageBtn.disabled = currentPage === 1;
            nextPageBtn.disabled = currentPage === totalPages;
        }

        function filterRows() {
            const filter = searchInput.value.toLowerCase();
            filteredRows = Array.from(rows).slice(1).filter(row => {
                const cells = row.getElementsByTagName('td');
                return Array.from(cells).some(cell => cell.innerText.toLowerCase().includes(filter));
            });

            // Hide all rows
            for (let i = 1; i < rows.length; i++) {
                rows[i].style.display = 'none';
            }

            // Show filtered rows
            filteredRows.forEach((row, index) => {
                if (index < rowsPerPage) {
                    row.style.display = '';
                }
            });

            // Reset pagination
            currentPage = 1;
            updatePagination();
        }

        function updatePagination() {
            const totalFilteredPages = Math.ceil(filteredRows.length / rowsPerPage);
            document.getElementById('currentPage').innerText = `Página ${currentPage} de ${totalFilteredPages}`;
            prevPageBtn.disabled = currentPage === 1;
            nextPageBtn.disabled = currentPage === totalFilteredPages;
        }

        searchInput.addEventListener('keyup', function() {
            filterRows();
            updatePagination();
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
<!-- Modal para actualizar profesor -->
<div class="modal fade" id="updateProfessorModal" tabindex="-1" aria-labelledby="updateProfessorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateProfessorModalLabel">Actualizar Profesor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateProfessorForm" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="updateProfessorId" name="id">
                    <div class="mb-3">
                        <label for="updateNombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="updateNombre" name="nombre_profesor" required>
                    </div>
                    <div class="mb-3">
                        <label for="updateDocumento" class="form-label">Documento</label>
                        <input type="text" class="form-control" id="updateDocumento" name="documento" required>
                    </div>
                    <div class="mb-3">
                        <label for="updateEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="updateEmail" name="email_profesor" required>
                    </div>
                    <div class="mb-3">
                        <label for="updateTelefono" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="updateTelefono" name="telefono_profesor" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar Profesor</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    // Script para llenar el modal de actualización
    const updateModal = document.getElementById('updateProfessorModal');
    updateModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // Botón que abrió el modal
        const id = button.getAttribute('data-id');
        const nombre = button.getAttribute('data-nombre');
        const documento = button.getAttribute('data-documento');
        const email = button.getAttribute('data-email');
        const telefono = button.getAttribute('data-telefono');

        const modalTitle = updateModal.querySelector('.modal-title');
        const modalBodyInputNombre = updateModal.querySelector('#updateNombre');
        const modalBodyInputDocumento = updateModal.querySelector('#updateDocumento');
        const modalBodyInputEmail = updateModal.querySelector('#updateEmail');
        const modalBodyInputTelefono = updateModal.querySelector('#updateTelefono');
        const modalBodyInputId = updateModal.querySelector('#updateProfessorId');

        modalTitle.textContent = 'Actualizar Profesor';
        modalBodyInputNombre.value = nombre;
        modalBodyInputDocumento.value = documento;
        modalBodyInputEmail.value = email;
        modalBodyInputTelefono.value = telefono;
        modalBodyInputId.value = id;

        // Cambiar la acción del formulario para actualizar el profesor
        const form = document.getElementById('updateProfessorForm');
        form.action = `/profesores/${id}`; // Ajusta la ruta según tu configuración de rutas
    });
</script>
</x-app-layout>
