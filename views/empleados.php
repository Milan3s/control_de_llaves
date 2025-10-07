<?php 
session_start();
if (!isset($_SESSION["id_usuario"])) {
    header("Location: login.php");
    exit;
}

require_once __DIR__ . "/../controllers/EmpleadoController.php";

$controller = new EmpleadoController();

// --- Paginación ---
$pagina = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
$porPagina = 10;

$datos = $controller->listarPaginado($pagina, $porPagina);
$empleados = $datos['empleados'];
$totalPaginas = $datos['total_paginas'];
?>

<?php include __DIR__ . "/../partials/header.php"; ?>
<?php include __DIR__ . "/../partials/navbar.php"; ?>

<div class="container">

    <div class="centrar-contenedor">
        <!-- Título -->
        <h2 class="fw-bold text-dark mb-2 text-center">
            <i class="fas fa-id-card text-warning"></i> Listado de Empleados
        </h2>

        <!-- Separador -->
        <hr class="w-50 mx-auto">

        <!-- Descripción -->
        <p class="text-muted mb-4 text-center">
            En esta tabla se muestran todos los empleados registrados en el sistema junto con su información 
            de contacto, la empresa a la que pertenecen y la fecha en la que fueron dados de alta.
        </p>

        <!-- Botón Nuevo -->
        <div class="contenedor-boton-nuevo-empleados mb-2">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalNuevoEmpleado">
                <i class="fas fa-plus"></i> Nuevo
            </button>
        </div>

        <!-- Mensajes de sesión -->
        <div class="contenedor-alerta-empleados">
            <?php if (isset($_SESSION['msg_success']) || isset($_SESSION['msg_error'])): ?>
                <div class="row">
                    <div class="col-md-8">
                        <?php if (isset($_SESSION['msg_success'])): ?>
                            <div class="alert alert-success alert-dismissible fade show text-center shadow-sm" role="alert">
                                <?= $_SESSION['msg_success']; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                            </div>
                            <?php unset($_SESSION['msg_success']); ?>
                        <?php endif; ?>

                        <?php if (isset($_SESSION['msg_error'])): ?>
                            <div class="alert alert-danger alert-dismissible fade show text-center shadow-sm" role="alert">
                                <?= $_SESSION['msg_error']; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                            </div>
                            <?php unset($_SESSION['msg_error']); ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Incluir modal de nuevo empleado -->
        <?php include __DIR__ . "/../cruds/empleados/nuevo.php"; ?>

        <!-- Buscador -->
        <div class="mb-3 my-3">
            <div class="input-group w-100">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
                <input type="text" id="buscadorEmpleados" class="form-control" placeholder="Buscar empleado...">
            </div>
        </div>

        <!-- Tabla -->
        <div class="table-container mt-3">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle shadow">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Teléfono 1</th>
                            <th>Teléfono 2</th>
                            <th>Empresa</th>
                            <th>Fecha Registro</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-center" id="tablaEmpleados">
                        <?php if (!empty($empleados)): ?>
                            <?php foreach ($empleados as $emp): ?>
                                <tr>
                                    <td><?= htmlspecialchars($emp["id_empleado"]); ?></td>
                                    <td><?= htmlspecialchars($emp["nombre"]); ?></td>
                                    <td><?= htmlspecialchars($emp["apellidos"]); ?></td>
                                    <td><?= htmlspecialchars($emp["telefono1"]); ?></td>
                                    <td>
                                        <?= !empty($emp["telefono2"]) 
                                            ? htmlspecialchars($emp["telefono2"]) 
                                            : "<span class='text-muted'>-</span>"; ?>
                                    </td>
                                    <td><?= htmlspecialchars($emp["nombre_empresa"]); ?></td>
                                    <td><?= (new DateTime($emp["fecha_registro"]))->format("d-m-Y H:i"); ?></td>
                                    <td>
                                        <!-- Botón Ver -->
                                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalVer<?= $emp['id_empleado']; ?>">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                        <!-- Botón Editar -->
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditar<?= $emp['id_empleado']; ?>">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <!-- Botón Eliminar -->
                                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalEliminar<?= $emp['id_empleado']; ?>">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Incluir modales -->
                                <?php 
                                    include __DIR__ . "/../cruds/empleados/ver.php"; 
                                    include __DIR__ . "/../cruds/empleados/editar.php"; 
                                    include __DIR__ . "/../cruds/empleados/borrar.php"; 
                                ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-muted">No hay empleados registrados.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Paginación -->
        <nav aria-label="Paginación de empleados">
            <ul class="pagination justify-content-center mt-3">
                <!-- Primero (<<) -->
                <li class="page-item <?= ($pagina <= 1) ? 'disabled' : '' ?>">
                    <a class="page-link" href="?pagina=1">&laquo;&laquo;</a>
                </li>

                <!-- Anterior (<) -->
                <li class="page-item <?= ($pagina <= 1) ? 'disabled' : '' ?>">
                    <a class="page-link" href="?pagina=<?= max(1, $pagina - 1) ?>">&lt;</a>
                </li>

                <!-- Números -->
                <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                    <li class="page-item <?= ($pagina == $i) ? 'active' : '' ?>">
                        <a class="page-link" href="?pagina=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>

                <!-- Siguiente (>) -->
                <li class="page-item <?= ($pagina >= $totalPaginas) ? 'disabled' : '' ?>">
                    <a class="page-link" href="?pagina=<?= min($totalPaginas, $pagina + 1) ?>">&gt;</a>
                </li>

                <!-- Último (>>) -->
                <li class="page-item <?= ($pagina >= $totalPaginas) ? 'disabled' : '' ?>">
                    <a class="page-link" href="?pagina=<?= $totalPaginas ?>">&raquo;&raquo;</a>
                </li>
            </ul>
        </nav>

    </div>
</div>

<!-- Script Buscador AJAX -->
<script>
document.getElementById("buscadorEmpleados").addEventListener("keyup", function() {
    const query = this.value;

    fetch("../cruds/empleados/buscarEmpleados.php?q=" + encodeURIComponent(query))
        .then(res => res.json())
        .then(data => {
            const tbody = document.getElementById("tablaEmpleados");
            tbody.innerHTML = "";

            if (data.length === 0) {
                tbody.innerHTML = `<tr><td colspan="8" class="text-muted">No se encontraron resultados.</td></tr>`;
                return;
            }

            data.forEach(emp => {
                tbody.innerHTML += `
                    <tr>
                        <td>${emp.id_empleado}</td>
                        <td>${emp.nombre}</td>
                        <td>${emp.apellidos}</td>
                        <td>${emp.telefono1}</td>
                        <td>${emp.telefono2 ?? '-'}</td>
                        <td>${emp.nombre_empresa}</td>
                        <td>${emp.fecha_registro}</td>
                        <td>
                            <button class="btn btn-info btn-sm"><i class="fas fa-eye"></i></button>
                            <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                        </td>
                    </tr>
                `;
            });
        })
        .catch(err => console.error("Error en búsqueda:", err));
});
</script>

<?php include __DIR__ . "/../partials/footer.php"; ?>
