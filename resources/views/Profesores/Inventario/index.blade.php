<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Aquí puedes agregar tus estilos personalizados */
    </style>
</head>

    <style>
        .top-nav {
            background: linear-gradient(to right, #39B54A, #2d8a3a);
            padding: 1rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .user-section {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-name {
            color: white;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .user-icon {
            background: rgba(255, 255, 255, 0.2);
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .user-icon svg {
            width: 20px;
            height: 20px;
            color: white;
        }

        .logout-btn {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 0.5rem 1rem;
            border-radius: 6px;
            text-decoration: none;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }

        .logout-btn svg {
            width: 18px;
            height: 18px;
        }

        @media (max-width: 640px) {
            .nav-container {
                padding: 0 1rem;
            }

            .user-name span {
                display: none;
            }
        }

        /* Estilos existentes de la tabla */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8f0;
            margin: 0;
            padding: 0;
        }

        .container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            padding: 20px 10px;
            width: 100%;
            max-width: 100%;
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
            table-layout: fixed;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px 8px;
            text-align: left;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        th:nth-child(6), td:nth-child(6),
        th:nth-child(10), td:nth-child(10) {
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

        .btn-custom {
            width: 200px;
            margin: 5px;
        }

        /* Resto de estilos existentes... */
    </style>

    <!-- Nueva barra de navegación -->
    <nav class="top-nav">
        <div class="nav-container">
            <div class="brand">
                {{-- <img src="https://certificadossena.net/wp-content/uploads/2022/10/logo-sena-negro-png-2022-300x294.png" alt="SENA" style="height: 40px;"> --}}
            </div>
            <div class="user-section">
                <div class="user-name">
                    <div class="user-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <span>{{ auth()->user()->name }}</span>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span>Cerrar sesión</span>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Contenido existente -->
    <div class="container">
        <h1>Inventario</h1>
        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Buscar en el inventario...">
        </div>
        <div class="table-container" style="overflow-x: auto;">
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
                    </tr>
                </thead>
                <tbody>
                    @foreach($Inventario as $inv)
                    <tr class="table-row" data-id="{{ $inv->id }}">
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


    <!-- Modal -->
<div class="modal fade" id="ambienteModal" tabindex="-1" aria-labelledby="ambienteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ambienteModalLabel">Seleccionar Ambiente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label for="ambienteSelect" class="form-label">Ambiente</label>
                <select id="ambienteSelect" class="form-select">
                    @foreach($Ambientes as $ambiente)
                        <option value="{{ $ambiente->id }}">{{ $ambiente->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="saveAmbienteBtn">Guardar</button>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const rows = document.querySelectorAll('.table-row');
        const ambienteModal = new bootstrap.Modal(document.getElementById('ambienteModal'));

        rows.forEach(row => {
            row.addEventListener('click', function() {
                // Aquí puedes obtener el ID del inventario si lo necesitas
                const inventarioId = this.getAttribute('data-id');

                // Aquí puedes realizar cualquier acción adicional, como cargar datos relacionados

                // Abre el modal
                ambienteModal.show();
            });
        });

        // Manejo del botón de guardar (puedes agregar la lógica que necesites)
        document.getElementById('saveAmbienteBtn').addEventListener('click', function() {
            const selectedAmbiente = document.getElementById('ambienteSelect').value;
            console.log('Ambiente seleccionado:', selectedAmbiente);
            // Aquí puedes agregar la lógica para guardar el ambiente seleccionado
            ambienteModal.hide(); // Cierra el modal
        });
    });
</script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const tableContainer = document.querySelector('.table-container');
            const table = document.getElementById('inventoryTable');
            const rows = table.getElementsByTagName('tr');
            const recordLimit = document.getElementById('recordLimit');
            const prevPageBtn = document.getElementById('prevPage');
            const nextPageBtn = document.getElementById('nextPage');
            const currentPageSpan = document.getElementById('currentPage');

            let currentPage = 1;
            let rowsPerPage = 10;

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
    </script>

