<?php 
session_start();
if (!isset($_SESSION["id_usuario"])) {
    header("Location: login.php");
    exit;
}

require_once __DIR__ . "/../controllers/RolController.php";

$controller = new RolController();

// Parámetros de paginación
$pagina = isset($_GET["pagina"]) ? (int)$_GET["pagina"] : 1;
$por_pagina = 10;

$resultado = $controller->listar($por_pagina, ($pagina - 1) * $por_pagina);
$roles = $resultado["data"];
$total = $resultado["total"];
$totalPaginas = $resultado["totalPaginas"];
?>

<?php include __DIR__ . "/../partials/header.php"; ?>
<?php include __DIR__ . "/../partials/navbar.php"; ?>

<div class="container">
    <div class="centrar-contenedor">
        <!-- Título -->
        <h2 class="fw-bold text-dark mb-2 text-center">
            <i class="fas fa-user-shield text-success"></i> Listado de Roles
        </h2>

        <!-- Separador -->
        <hr class="w-50 mx-auto">

        <!-- Descripción -->
        <p class="text-muted mb-4 text-center">
            En esta tabla se muestran todos los roles definidos en el sistema junto con su descripción. 
            Los roles permiten asignar permisos y definir responsabilidades a los distintos usuarios.
        </p>

        <!-- Botón Nuevo + Alertas -->
        <div class="d-flex justify-content-between align-items-center mb-2">
            <!-- Botón Nuevo -->
            <div>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalNuevoRol">
                    <i class="fas fa-plus"></i> Nuevo Rol
                </button>
            </div>

            <!-- Alertas -->
            <div class="flex-grow-1 ms-3">
                <?php if (isset($_SESSION['msg_success'])): ?>
                    <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                        <i class="fas fa-check-circle"></i> <?= $_SESSION['msg_success']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                    </div>
                    <?php unset($_SESSION['msg_success']); ?>
                <?php endif; ?>

                <?php if (isset($_SESSION['msg_error'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                        <i class="fas fa-times-circle"></i> <?= $_SESSION['msg_error']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                    </div>
                    <?php unset($_SESSION['msg_error']); ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Incluimos modal de nuevo rol -->
        <?php include __DIR__ . "/../cruds/roles/nuevo.php"; ?>

        <!-- Buscador -->
        <div class="mb-3 my-3">
            <div class="input-group w-100">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
                <input type="text" id="buscadorRoles" class="form-control" placeholder="Buscar rol...">
            </div>
        </div>

        <!-- Tabla -->
        <div class="table-container mt-3">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle shadow">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>ID</th>
                            <th>Nombre del Rol</th>
                            <th>Descripción</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-center" id="tablaRoles">
                        <?php if (!empty($roles)): ?>
                            <?php foreach ($roles as $r): ?>
                                <tr>
                                    <td><?= htmlspecialchars($r["id_rol"]); ?></td>
                                    <td><?= htmlspecialchars($r["nombre_rol"]); ?></td>
                                    <td><?= htmlspecialchars($r["descripcion"]); ?></td>
                                    <td>
                                        <!-- Botón Ver -->
                                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalVer<?= $r['id_rol']; ?>">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                        <!-- Botón Editar -->
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditar<?= $r['id_rol']; ?>">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <!-- Botón Eliminar -->
                                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalEliminar<?= $r['id_rol']; ?>">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Incluimos modales -->
                                <?php 
                                    include __DIR__ . "/../cruds/roles/ver.php"; 
                                    include __DIR__ . "/../cruds/roles/editar.php"; 
                                    include __DIR__ . "/../cruds/roles/borrar.php"; 
                                ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-muted">
                                    No hay roles registrados.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Paginación -->
        <nav aria-label="Paginación de roles">
            <ul class="pagination justify-content-center mt-3">
                <!-- Primera página -->
                <li class="page-item <?= ($pagina <= 1) ? 'disabled' : '' ?>">
                    <a class="page-link" href="?pagina=1">&laquo;</a>
                </li>

                <!-- Página anterior -->
                <li class="page-item <?= ($pagina <= 1) ? 'disabled' : '' ?>">
                    <a class="page-link" href="?pagina=<?= max(1, $pagina - 1); ?>">&lt;</a>
                </li>

                <!-- Números de página -->
                <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                    <li class="page-item <?= ($i == $pagina) ? 'active' : '' ?>">
                        <a class="page-link" href="?pagina=<?= $i; ?>"><?= $i; ?></a>
                    </li>
                <?php endfor; ?>

                <!-- Página siguiente -->
                <li class="page-item <?= ($pagina >= $totalPaginas) ? 'disabled' : '' ?>">
                    <a class="page-link" href="?pagina=<?= min($totalPaginas, $pagina + 1); ?>">&gt;</a>
                </li>

                <!-- Última página -->
                <li class="page-item <?= ($pagina >= $totalPaginas) ? 'disabled' : '' ?>">
                    <a class="page-link" href="?pagina=<?= $totalPaginas; ?>">&raquo;</a>
                </li>
            </ul>
        </nav>
    </div>
</div>

<!-- Script Buscador AJAX -->
<script>
document.getElementById("buscadorRoles").addEventListener("keyup", function() {
    const query = this.value;

    fetch("../cruds/roles/buscarRoles.php?q=" + encodeURIComponent(query))
        .then(res => res.json())
        .then(data => {
            const tbody = document.getElementById("tablaRoles");
            tbody.innerHTML = "";

            if (data.length === 0) {
                tbody.innerHTML = `<tr><td colspan="4" class="text-muted">No se encontraron resultados.</td></tr>`;
                return;
            }

            data.forEach(r => {
                tbody.innerHTML += `
                    <tr>
                        <td>${r.id_rol}</td>
                        <td>${r.nombre_rol}</td>
                        <td>${r.descripcion}</td>
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
