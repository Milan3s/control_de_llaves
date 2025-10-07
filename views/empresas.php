<?php 
session_start();
if (!isset($_SESSION["id_usuario"])) {
    header("Location: login.php");
    exit;
}

require_once __DIR__ . "/../controllers/EmpresaController.php";

$controller = new EmpresaController();

// Paginación
$pagina = isset($_GET["pagina"]) ? (int)$_GET["pagina"] : 1;
$porPagina = 10;

$datos = $controller->listarPaginado($pagina, $porPagina);
$empresas = $datos["empresas"];
$totalPaginas = $datos["total_paginas"];
?>

<?php include __DIR__ . "/../partials/header.php"; ?>
<?php include __DIR__ . "/../partials/navbar.php"; ?>

<div class="container">
    <div class="centrar-contenedor">
        <!-- Título -->
        <h2 class="fw-bold text-dark mb-2 text-center">
            <i class="fas fa-building text-info"></i> Listado de Empresas
        </h2>

        <!-- Separador -->
        <hr class="w-50 mx-auto">

        <!-- Descripción -->
        <p class="text-muted mb-4 text-center">
            En esta tabla se muestran todas las empresas registradas en el sistema junto con su información de contacto.
            Aquí podrás consultar y administrar los datos de cada empresa vinculada.
        </p>

        <!-- Botón Nuevo -->
        <div class="contenedor-boton-nuevo-empresas mb-3">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalNuevaEmpresa">
                <i class="fas fa-plus"></i> Nueva
            </button>
        </div>

        <!-- Mensajes de sesión -->
        <div class="contenedor-alerta-empresas">
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

        <!-- Incluir modal de nueva empresa -->
        <?php include __DIR__ . "/../cruds/empresas/nuevo.php"; ?>

        <!-- Buscador -->
        <div class="mb-3 my-3">
            <div class="input-group w-100">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
                <input type="text" id="buscadorEmpresas" class="form-control" placeholder="Buscar empresa...">
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
                            <th>Dirección</th>
                            <th>Teléfono</th>
                            <th>Email</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-center" id="tablaEmpresas">
                        <?php if (!empty($empresas)): ?>
                            <?php foreach ($empresas as $e): ?>
                                <tr>
                                    <td><?= htmlspecialchars($e["id_empresa"]); ?></td>
                                    <td><?= htmlspecialchars($e["nombre_empresa"]); ?></td>
                                    <td><?= htmlspecialchars($e["direccion"]); ?></td>
                                    <td><?= htmlspecialchars($e["telefono"]); ?></td>
                                    <td><?= htmlspecialchars($e["email"]); ?></td>
                                    <td>
                                        <!-- Botón Ver -->
                                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalVer<?= $e['id_empresa']; ?>">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                        <!-- Botón Editar -->
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditar<?= $e['id_empresa']; ?>">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <!-- Botón Eliminar -->
                                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalEliminar<?= $e['id_empresa']; ?>">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Incluir modales -->
                                <?php 
                                    include __DIR__ . "/../cruds/empresas/ver.php"; 
                                    include __DIR__ . "/../cruds/empresas/editar.php"; 
                                    include __DIR__ . "/../cruds/empresas/borrar.php"; 
                                ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-muted">
                                    No hay empresas registradas.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Paginación -->
        <nav aria-label="Paginación de empresas">
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
document.getElementById("buscadorEmpresas").addEventListener("keyup", function() {
    const query = this.value;

    fetch("../cruds/empresas/buscarEmpresas.php?q=" + encodeURIComponent(query))
        .then(res => res.json())
        .then(data => {
            const tbody = document.getElementById("tablaEmpresas");
            tbody.innerHTML = "";

            if (data.length === 0) {
                tbody.innerHTML = `<tr><td colspan="6" class="text-muted">No se encontraron resultados.</td></tr>`;
                return;
            }

            data.forEach(e => {
                tbody.innerHTML += `
                    <tr>
                        <td>${e.id_empresa}</td>
                        <td>${e.nombre_empresa}</td>
                        <td>${e.direccion}</td>
                        <td>${e.telefono}</td>
                        <td>${e.email}</td>
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
