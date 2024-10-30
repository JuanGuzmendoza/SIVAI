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
        .btn-custom {
    width: 200px; /* Ajusta el ancho según sea necesario */
    margin: 5px; /* Espaciado entre los botones */
}
    </style>

    <div class="container">
        <h1>Inventario</h1>
        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Buscar en el inventario...">
        </div>
        <!-- Los filtros de centro y tipo han sido eliminados -->
        <div class="button-container">
            <button class="btn btn-success btn-custom"data-bs-toggle="modal" data-bs-target="#importModal">Importar Excel</button>
            <button class="btn btn-success btn-custom" data-bs-toggle="modal" data-bs-target="#addRecordModal">Agregar Registro</button>
            <a href="{{ route('exportar') }}" class="btn btn-success btn-custom">Descargar plantilla de Excel</a>
        </div>
        <div class="table-container" style="overflow-x: auto;">  <!-- Update: Added table container -->
            <table id="inventoryTable">
                <thead>
                    <tr>
                        <th>R</th>
                        <th>Centro</th>
                        <th>Modelo</th>
                        <th>Consec</th>
                        <th>Desc</th>
                        <th>Descripción Actual</th>
                        <th>Tipo</th>
                        <th>Mod</th>
                        <th>Placa</th>
                        <th>Atributos</th>
                        <th>Fecha Adquisición</th>
                        <th>Valor Ingreso</th>
                        <th>Ambiente ID</th>
                        <th>Profesor ID</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($Inventario as $inv)
                    <tr>
                        <td>{{ $inv->R }}</td>
                        <td>{{ $inv->centro }}</td>
                        <td>{{ $inv->modelo }}</td>
                        <td>{{ $inv->consec }}</td>
                        <td>{{ $inv->desc }}</td>
                        <td>{{ $inv->descripcion_actual }}</td>
                        <td>{{ $inv->tipo }}</td>
                        <td>{{ $inv->mod }}</td>
                        <td>{{ $inv->placa }}</td>
                        <td>{{ $inv->atributos }}</td>
                        <td>{{ $inv->fecha_adquisicion }}</td>
                        <td>{{ $inv->valor_ingreso }}</td>
                        <td>{{ optional($inv->ambiente)->nombre }}</td>
                        <td>{{ optional($inv->profesor)->nombre_profesor }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div> <!-- Update: Closed table container -->
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



<!-- Modal para Agregar Registro -->
<div class="modal fade" id="addRecordModal" tabindex="-1" aria-labelledby="addRecordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="addRecordModalLabel">Agregar Registro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('inventarios.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="centro" class="form-label">R</label>
                        <input type="text" class="form-control" id="R" name="R" required>
                    </div>
                    <div class="mb-3">
                        <label for="centro" class="form-label">Centro</label>
                        <input type="text" class="form-control" id="centro" name="centro" required>
                    </div>
                    <div class="mb-3">
                        <label for="modelo" class="form-label">Modelo</label>
                        <input type="text" class="form-control" id="modelo" name="modelo" required>
                    </div>
                    <div class="mb-3">
                        <label for="consec" class="form-label">Consec</label>
                        <input type="text" class="form-control" id="consec" name="consec" required>
                    </div>
                    <div class="mb-3">
                        <label for="desc" class="form-label">Descripción</label>
                        <input type="text" class="form-control" id="desc" name="desc" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion_actual" class="form-label">Descripción Actual</label>
                        <input type="text" class="form-control" id="descripcion_actual" name="descripcion_actual" required>
                    </div>
                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tipo</label>
                        <input type="text" class="form-control" id="tipo" name="tipo" required>
                    </div>
                    <div class="mb-3">
                        <label for="mod" class="form-label">Mod</label>
                        <input type="text" class="form-control" id="mod" name="mod" required>
                    </div>
                    <div class="mb-3">
                        <label for="placa" class="form-label">Placa</label>
                        <input type="text" class="form-control" id="placa" name="placa" required>
                    </div>
                    <div class="mb-3">
                        <label for="atributos" class="form-label">Atributos</label>
                        <input type="text" class="form-control" id="atributos" name="atributos" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_adquisicion" class="form-label">Fecha Adquisición</label>
                        <input type="date" class="form-control" id="fecha_adquisicion" name="fecha_adquisicion" required>
                    </div>
                    <div class="mb-3">
                        <label for="valor_ingreso" class="form-label">Valor Ingreso</label>
                        <input type="number" class="form-control" id="valor_ingreso" name="valor_ingreso" required>
                    </div>
                    <div class="mb-3">
                        <label for="ambiente_id" class="form-label">Ambiente ID</label>
                        <select class="form-select" id="ambiente_id" name="ambiente_id" required>
                            <option value="">Seleccione un ambiente</option>
                            @foreach($Ambientes as $ambiente)
                                <option value="{{ $ambiente->id }}">{{ $ambiente->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="profesor_id" class="form-label">Profesor ID</label>
                        <select class="form-select" id="profesor_id" name="profesor_id" required>
                            <option value="">Seleccione un profesor</option>
                            @foreach($Profesores as $profesor)
                                <option value="{{ $profesor->id }}">{{ $profesor->nombre_profesor }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Agregar Registro</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    <!-- Import Modal -->
    <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="importModalLabel">Importar Excel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('importar') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="fileInput" class="form-label">Subir archivo</label>
                            <input type="file" class="form-control" name="fileInput" accept=".xlsx, .xls, .csv">
                        </div>
                        <div class="mb-3">
                            <label for="profesorSelect" class="form-label">Seleccionar Profesor</label>
                            <select class="form-select" id="profesorSelect" name="profesor_id">
                                <option value="">Seleccione un profesor</option>
                                @foreach($Profesores as $profesor)
                                    <option value="{{ $profesor->id }}">{{ $profesor->nombre_profesor }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-success">Importar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const tableContainer = document.querySelector('.table-container');  <!-- Update: Added tableContainer -->
            const table = document.getElementById('inventoryTable');  <!-- Update: No change needed here -->
            const rows = table.getElementsByTagName('tr');
            const recordLimit = document.getElementById('recordLimit');
            const prevPageBtn = document.getElementById('prevPage');
            const nextPageBtn = document.getElementById('nextPage');
            const currentPageSpan = document.getElementById('currentPage');

            let currentPage = 1;
            let rowsPerPage = 10;

            // Populate filter options
            //const centers = new Set();
            //const types = new Set();
            //for (let i = 1; i < rows.length; i++) {
            //    if (rows[i].cells[1].innerText && !centers.has(rows[i].cells[1].innerText)) {
            //        centers.add(rows[i].cells[1].innerText);
            //        const option = document.createElement('option');
            //        option.value = rows[i].cells[1].innerText;
            //        option.textContent = rows[i].cells[1].innerText;
            //        centerFilter.appendChild(option);
            //    }
            //    if (rows[i].cells[6].innerText && !types.has(rows[i].cells[6].innerText)) {
            //        types.add(rows[i].cells[6].innerText);
            //        const option = document.createElement('option');
            //        option.value = rows[i].cells[6].innerText;
            //        option.textContent = rows[i].cells[6].innerText;
            //        typeFilter.appendChild(option);
            //    }
            //}


            function filterTable() {
                const searchTerm = searchInput.value.toLowerCase();
                let visibleRows = 0;

                for (let i = 1; i < rows.length; i++) {
                    const cells = rows[i].getElementsByTagName('td');
                    let rowMatches = false;

                    for (let j = 0; j < cells.length; j++) {
                        const cellContent = cells[j].innerText.toLowerCase();
                        if (cellContent.includes(searchTerm)) {
                            rowMatches = true;
                            break;
                        }
                    }

                    if (rowMatches) {
                        visibleRows++;
                        const shouldBeVisible = visibleRows > (currentPage - 1) * rowsPerPage && visibleRows <= currentPage * rowsPerPage;
                        rows[i].style.display = shouldBeVisible ? '' : 'none';
                    } else {
                        rows[i].style.display = 'none';
                    }
                }

                updatePagination(visibleRows);
            }

            function updatePagination(totalRows) {
                const totalPages = Math.ceil(totalRows / rowsPerPage);
                currentPageSpan.textContent = `Página ${currentPage} de ${totalPages}`;
                prevPageBtn.disabled = currentPage === 1;
                nextPageBtn.disabled = currentPage === totalPages;
            }

            searchInput.addEventListener('keyup', filterTable);
            //centerFilter.addEventListener('change', filterTable);
            //typeFilter.addEventListener('change', filterTable);
            recordLimit.addEventListener('change', function() {
                rowsPerPage = parseInt(this.value);
                currentPage = 1;
                filterTable();
            });

            prevPageBtn.addEventListener('click', function() {
                if (currentPage > 1) {
                    currentPage--;
                    filterTable();
                }
            });

            nextPageBtn.addEventListener('click', function() {
                currentPage++;
                filterTable();
            });

            // Initial filter
            filterTable();

            // Sorting functionality
            const headers = table.getElementsByTagName('th');
            for (let i = 0; i < headers.length; i++) {
                headers[i].addEventListener('click', function() {
                    sortTable(i);
                });
            }

            function sortTable(n) {
                let switching = true;
                let shouldSwitch, dir = 'asc';
                let switchcount = 0;

                while (switching) {
                    switching = false;
                    for (let i = 1; i < (rows.length - 1); i++) {
                        shouldSwitch = false;
                        const x = rows[i].getElementsByTagName('td')[n];
                        const y = rows[i + 1].getElementsByTagName('td')[n];
                        if (dir === 'asc') {
                            if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                                shouldSwitch = true;
                                break;
                            }
                        } else if (dir === 'desc') {
                            if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                                shouldSwitch = true;
                                break;
                            }
                        }
                    }
                    if (shouldSwitch) {
                        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                        switching = true;
                        switchcount++;
                    } else {
                        if (switchcount === 0 && dir === 'asc') {
                            dir = 'desc';
                            switching = true;
                        }
                    }
                }
                filterTable();
            }
        });

        function downloadTemplate() {
            // Implement the logic to download the Excel template
            alert('Descargando plantilla de Excel...');
            // You might want to replace this with an actual download functionality
        }
    </script>
</x-app-layout>
