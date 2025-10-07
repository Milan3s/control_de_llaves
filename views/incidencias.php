<?php 
session_start();
if (!isset($_SESSION["id_usuario"])) {
    header("Location: login.php");
    exit;
}

require_once __DIR__ . "/../controllers/IncidenciaController.php";

$controller = new IncidenciaController();

// --- Paginación ---
$pagina = isset($_GET["pagina"]) ? (int) $_GET["pagina"] : 1;
$porPagina = 10;

$datos = $controller->listarPaginado($pagina, $porPagina);
$incidencias = $datos["incidencias"];
$totalPaginas = $datos["total_paginas"];
?>

<?php include __DIR__ . "/../partials/header.php"; ?>
<?php include __DIR__ . "/../partials/navbar.php"; ?>

<div class="container">
    <div class="centrar-contenedor">
        
        <!-- Título -->
        <h2 class="fw-bold text-dark mb-2 text-center">
            <i class="fas fa-exclamation-circle text-danger"></i> Listado de Incidencias
        </h2>

        <hr class="w-50 mx-auto">

        <!-- Descripción -->
        <p class="text-muted mb-4 text-center">
            Aquí se muestran todas las incidencias registradas en el sistema, asociadas a llaves y empleados,
            con detalles de tipo, descripción, usuario que la reportó y estado.
        </p>

        <!-- Botón Nueva Incidencia -->
        <div class="contenedor-boton-nuevo-incidencias mb-3">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalNuevaIncidencia">
                <i class="fas fa-plus"></i> Nueva Incidencia
            </button>
        </div>

        <!-- Buscador -->
        <div class="mb-3 my-3">
            <div class="input-group w-100">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
                <input type="text" id="buscadorIncidencias" class="form-control" placeholder="Buscar por tipo, descripción, código de llave o empleado...">
            </div>
        </div>

        <!-- Mensajes -->
        <div class="contenedor-alerta-incidencias">
            <?php if (isset($_SESSION['msg_success']) || isset($_SESSION['msg_error'])): ?>
                <div class="row">
                    <div class="col-md-8">

                        <?php if (isset($_SESSION['msg_success'])): ?>
                            <div class="alert alert-success alert-dismissible fade show text-center shadow-sm" role="alert">
                                <?= $_SESSION['msg_success']; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                            <?php unset($_SESSION['msg_success']); ?>
                        <?php endif; ?>

                        <?php if (isset($_SESSION['msg_error'])): ?>
                            <div class="alert alert-danger alert-dismissible fade show text-center shadow-sm" role="alert">
                                <?= $_SESSION['msg_error']; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                            <?php unset($_SESSION['msg_error']); ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Modal Nueva Incidencia -->
        <?php include __DIR__ . "/../cruds/incidencias/nuevo.php"; ?>

        <!-- Tabla -->
        <div class="table-container mt-3">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle shadow">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>ID</th>
                            <th>Llave</th>
                            <th>Empleado</th>
                            <th>Tipo</th>
                            <th>Descripción</th>
                            <th>Fecha</th>
                            <th>Resuelta</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-center" id="tablaIncidencias">
                        <?php if (!empty($incidencias)): ?>
                            <?php foreach ($incidencias as $i): ?>
                                <tr>
                                    <td><?= htmlspecialchars($i["id_incidencia"]); ?></td>
                                    <td><?= htmlspecialchars($i["codigo_llave"]); ?></td>
                                    <td><?= htmlspecialchars($i["nombre_empleado"] . " " . $i["apellidos_empleado"]); ?></td>
                                    <td>
                                        <span class="badge 
                                            <?= $i["tipo_incidencia"] == "perdida" ? "bg-danger" : 
                                            ($i["tipo_incidencia"] == "daniada" ? "bg-warning text-dark" : 
                                            ($i["tipo_incidencia"] == "retraso" ? "bg-info text-dark" : "bg-secondary")); ?>">
                                            <?= htmlspecialchars($i["tipo_incidencia"]); ?>
                                        </span>
                                    </td>
                                    <td class="text-start"><?= htmlspecialchars($i["descripcion"]); ?></td>
                                    <td><?= (new DateTime($i["fecha_incidencia"]))->format("d-m-Y H:i"); ?></td>
                                    <td>
                                        <?= $i["resuelta"] ? 
                                            '<span class="badge bg-success">Sí</span>' : 
                                            '<span class="badge bg-danger">No</span>'; ?>
                                    </td>
                                    <td>
                                        <!-- Ver -->
                                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalVer<?= $i['id_incidencia']; ?>">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <!-- Editar -->
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditar<?= $i['id_incidencia']; ?>">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <!-- Eliminar -->
                                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalEliminar<?= $i['id_incidencia']; ?>">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Modales -->
                                <?php 
                                    include __DIR__ . "/../cruds/incidencias/ver.php"; 
                                    include __DIR__ . "/../cruds/incidencias/editar.php"; 
                                    include __DIR__ . "/../cruds/incidencias/borrar.php"; 
                                ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-muted">No hay incidencias registradas.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Paginación -->
        <nav aria-label="Paginación de incidencias">
            <ul class="pagination justify-content-center mt-3">
                <!-- Primero -->
                <li class="page-item <?= ($pagina <= 1) ? 'disabled' : '' ?>">
                    <a class="page-link" href="?pagina=1">&laquo;&laquo;</a>
                </li>
                <!-- Anterior -->
                <li class="page-item <?= ($pagina <= 1) ? 'disabled' : '' ?>">
                    <a class="page-link" href="?pagina=<?= max(1, $pagina - 1) ?>">&lt;</a>
                </li>
                <!-- Números -->
                <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                    <li class="page-item <?= ($pagina == $i) ? 'active' : '' ?>">
                        <a class="page-link" href="?pagina=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
                <!-- Siguiente -->
                <li class="page-item <?= ($pagina >= $totalPaginas) ? 'disabled' : '' ?>">
                    <a class="page-link" href="?pagina=<?= min($totalPaginas, $pagina + 1) ?>">&gt;</a>
                </li>
                <!-- Último -->
                <li class="page-item <?= ($pagina >= $totalPaginas) ? 'disabled' : '' ?>">
                    <a class="page-link" href="?pagina=<?= $totalPaginas ?>">&raquo;&raquo;</a>
                </li>
            </ul>
        </nav>

    </div>
</div>

<!-- Script Buscador AJAX -->
<script>
document.getElementById("buscadorIncidencias").addEventListener("keyup", function() {
    const query = this.value;

    fetch("../cruds/incidencias/buscarIncidencias.php?q=" + encodeURIComponent(query))
        .then(res => res.json())
        .then(data => {
            const tbody = document.getElementById("tablaIncidencias");
            tbody.innerHTML = "";

            if (data.length === 0) {
                tbody.innerHTML = `<tr><td colspan="8" class="text-muted">No se encontraron resultados.</td></tr>`;
                return;
            }

            data.forEach(i => {
                tbody.innerHTML += `
                    <tr>
                        <td>${i.id_incidencia}</td>
                        <td>${i.codigo_llave}</td>
                        <td>${i.nombre_empleado} ${i.apellidos_empleado}</td>
                        <td><span class="badge bg-secondary">${i.tipo_incidencia}</span></td>
                        <td class="text-start">${i.descripcion}</td>
                        <td>${i.fecha_incidencia}</td>
                        <td>
                            ${i.resuelta == 1 
                                ? '<span class="badge bg-success">Sí</span>' 
                                : '<span class="badge bg-danger">No</span>'}
                        </td>
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
