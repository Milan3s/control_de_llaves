<?php
session_start();
if (!isset($_SESSION["id_usuario"])) {
    header("Location: login.php");
    exit;
}

require_once __DIR__ . "/../controllers/LlaveController.php";

$controller = new LlaveController();

// --- Paginación ---
$pagina = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
$porPagina = 10;

$datos = $controller->listarPaginado($pagina, $porPagina);
$llaves = $datos["llaves"];
$totalPaginas = $datos["total_paginas"];
?>

<?php include __DIR__ . "/../partials/header.php"; ?>
<?php include __DIR__ . "/../partials/navbar.php"; ?>

<div class="container">
    <div class="centrar-contenedor">
        <!-- Título -->
        <h2 class="fw-bold text-dark mb-2 text-center">
            <i class="fas fa-key text-secondary"></i> Listado de Llaves
        </h2>

        <!-- Separador -->
        <hr class="w-50 mx-auto">

        <!-- Descripción -->
        <p class="text-muted mb-4 text-center">
            En esta tabla se muestran todas las llaves registradas en el sistema, con su código, descripción, 
            la empresa a la que pertenecen y el historial de uso por parte de los empleados.
        </p>

        <!-- Botón Nuevo -->
        <div class="contenedor-boton-nuevo-llaves mb-3">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalNuevaLlave">
                <i class="fas fa-plus"></i> Nueva Llave
            </button>
        </div>

        <!-- Mensajes -->
        <div class="contenedor-alerta-llaves">
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

        <!-- Modal Nuevo -->
        <?php include __DIR__ . "/../cruds/llaves/nuevo.php"; ?>

        <!-- Buscador -->
        <div class="mb-3 my-3">
            <div class="input-group w-100">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
                <input type="text" id="buscadorLlaves" class="form-control" placeholder="Buscar por código, descripción, empleado o empresa...">
            </div>
        </div>

        <!-- Tabla -->
        <div class="table-container mt-3">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle shadow">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>ID</th>
                            <th>Código</th>
                            <th>Descripción</th>
                            <th>Empleado</th>
                            <th>Empresa</th>
                            <th>Hora Cogido</th>
                            <th>Hora Dejado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-center" id="tablaLlaves">
                        <?php if (!empty($llaves)): ?>
                            <?php foreach ($llaves as $l): ?>
                                <tr>
                                    <td><?= htmlspecialchars($l["id_llave"]); ?></td>
                                    <td><?= htmlspecialchars($l["codigo_llave"]); ?></td>
                                    <td><?= htmlspecialchars($l["descripcion"]); ?></td>
                                    <td>
                                        <?php if (!empty($l["id_empleado"])): ?>
                                            <?= htmlspecialchars($l["nombre_empleado"] . " " . $l["apellidos_empleado"]); ?>
                                        <?php else: ?>
                                            <span class="text-muted">No asignado</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if (!empty($l["id_empresa"])): ?>
                                            <?= htmlspecialchars($l["nombre_empresa"]); ?>
                                        <?php else: ?>
                                            <span class="text-muted">No asignada</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if (!empty($l["hora_cogido"]) && $l["hora_cogido"] != "0000-00-00 00:00:00"): ?>
                                            <?= htmlspecialchars((new DateTime($l["hora_cogido"]))->format("d-m-Y H:i")); ?>
                                        <?php else: ?>
                                            <span class="badge bg-danger">NO</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if (!empty($l["hora_dejado"]) && $l["hora_dejado"] != "0000-00-00 00:00:00"): ?>
                                            <?= htmlspecialchars((new DateTime($l["hora_dejado"]))->format("d-m-Y H:i")); ?>
                                        <?php else: ?>
                                            <span class="badge bg-danger">NO</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <!-- Botón Ver -->
                                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalVer<?= $l['id_llave']; ?>">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                        <!-- Botón Editar -->
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditar<?= $l['id_llave']; ?>">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <!-- Botón Eliminar -->
                                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalEliminar<?= $l['id_llave']; ?>">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Incluimos modales -->
                                <?php 
                                    include __DIR__ . "/../cruds/llaves/ver.php"; 
                                    include __DIR__ . "/../cruds/llaves/editar.php"; 
                                    include __DIR__ . "/../cruds/llaves/borrar.php"; 
                                ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-muted">No hay llaves registradas.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Paginación -->
        <nav aria-label="Paginación de llaves">
            <ul class="pagination justify-content-center mt-3">
                <li class="page-item <?= ($pagina <= 1) ? 'disabled' : '' ?>">
                    <a class="page-link" href="?pagina=1">&laquo;&laquo;</a>
                </li>
                <li class="page-item <?= ($pagina <= 1) ? 'disabled' : '' ?>">
                    <a class="page-link" href="?pagina=<?= max(1, $pagina - 1) ?>">&lt;</a>
                </li>
                <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                    <li class="page-item <?= ($pagina == $i) ? 'active' : '' ?>">
                        <a class="page-link" href="?pagina=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?= ($pagina >= $totalPaginas) ? 'disabled' : '' ?>">
                    <a class="page-link" href="?pagina=<?= min($totalPaginas, $pagina + 1) ?>">&gt;</a>
                </li>
                <li class="page-item <?= ($pagina >= $totalPaginas) ? 'disabled' : '' ?>">
                    <a class="page-link" href="?pagina=<?= $totalPaginas ?>">&raquo;&raquo;</a>
                </li>
            </ul>
        </nav>

    </div>
</div>

<!-- Script Buscador AJAX -->
<script>
document.getElementById("buscadorLlaves").addEventListener("keyup", function() {
    const query = this.value;

    fetch("../cruds/llaves/buscarLlaves.php?q=" + encodeURIComponent(query))
        .then(res => res.json())
        .then(data => {
            const tbody = document.getElementById("tablaLlaves");
            tbody.innerHTML = "";

            if (data.length === 0) {
                tbody.innerHTML = `<tr><td colspan="8" class="text-muted">No se encontraron resultados.</td></tr>`;
                return;
            }

            data.forEach(l => {
                tbody.innerHTML += `
                    <tr>
                        <td>${l.id_llave}</td>
                        <td>${l.codigo_llave}</td>
                        <td>${l.descripcion}</td>
                        <td>${l.nombre_empleado ? l.nombre_empleado + " " + l.apellidos_empleado : '<span class="text-muted">No asignado</span>'}</td>
                        <td>${l.nombre_empresa ? l.nombre_empresa : '<span class="text-muted">No asignada</span>'}</td>
                        <td>${(l.hora_cogido && l.hora_cogido !== "0000-00-00 00:00:00") ? l.hora_cogido : '<span class="badge bg-danger">NO</span>'}</td>
                        <td>${(l.hora_dejado && l.hora_dejado !== "0000-00-00 00:00:00") ? l.hora_dejado : '<span class="badge bg-danger">NO</span>'}</td>
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
