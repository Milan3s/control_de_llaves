<?php 
session_start();
if (!isset($_SESSION["id_usuario"])) {
    header("Location: login.php");
    exit;
}

require_once __DIR__ . "/../controllers/UsuarioController.php";

$controller = new UsuarioController();

// --- Paginación inicial ---
$pagina = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
$porPagina = 5; 

$resultado = $controller->listarPaginado($pagina, $porPagina);
$usuarios = $resultado['usuarios'];
$totalPaginas = $resultado['total_paginas'];
?>

<?php include __DIR__ . "/../partials/header.php"; ?>
<?php include __DIR__ . "/../partials/navbar.php"; ?>

<div class="container">
    <div class="centrar-contenedor">

        <!-- Título -->
        <h2 class="fw-bold text-dark mb-2 text-center">
            <i class="fas fa-users text-primary"></i> Listado de Usuarios
        </h2>

        <hr class="w-50 mx-auto">

        <p class="text-muted mb-4 text-center">
            En esta tabla se muestran todos los usuarios registrados en el sistema junto con su correo, 
            rol asignado y estado de actividad.
        </p>

        <!-- Botón Nuevo -->       
        <div class="mb-2">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalNuevoUsuario">
                <i class="fas fa-plus"></i> Nuevo
            </button>
        </div>

        <!-- Alertas -->
        <div class="contenedor-alerta-usuarios mb-3">
            <?php if (isset($_SESSION['msg_success']) || isset($_SESSION['msg_error'])): ?>
                <div class="row">
                    <div class="col-md-12">
                        <?php if (isset($_SESSION['msg_success'])): ?>
                            <div class="alert alert-success alert-dismissible fade show text-center shadow-sm" role="alert">
                                <?= $_SESSION['msg_success']; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                            <?php unset($_SESSION['msg_success']); ?>
                        <?php endif; ?>

                        <?php if (isset($_SESSION['msg_error'])): ?>
                            <?php 
                                $errorMsg = $_SESSION['msg_error'];
                                $alertClass = (stripos($errorMsg, "ya está en uso") !== false) ? "alert-warning" : "alert-danger";
                            ?>
                            <div class="alert <?= $alertClass; ?> alert-dismissible fade show text-center shadow-sm" role="alert">
                                <?= $errorMsg; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                            <?php unset($_SESSION['msg_error']); ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Modal Nuevo Usuario -->
        <?php include __DIR__ . "/../cruds/usuarios/nuevo.php"; ?>

        <!-- Buscador (ocupa todo el ancho debajo del botón y alertas) -->
        <div class="mb-3 my-3">
            <div class="input-group w-100">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
                <input type="text" id="buscadorGlobal" class="form-control" placeholder="Buscar usuario, email o rol...">
            </div>
        </div>

        <!-- Tabla -->
        <div class="table-container mt-3">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle shadow">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Activo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-center" id="tablaUsuarios">
                        <?php if (!empty($usuarios)): ?>
                            <?php foreach ($usuarios as $u): ?>
                                <tr>
                                    <td><?= htmlspecialchars($u["id_usuario"]); ?></td>
                                    <td><?= htmlspecialchars($u["nombre_usuario"]); ?></td>
                                    <td><?= htmlspecialchars($u["email"]); ?></td>
                                    <td><?= htmlspecialchars($u["rol"]); ?></td>
                                    <td>
                                        <?php if ($u["activo"]): ?>
                                            <span class="badge bg-success">Sí</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">No</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <!-- Botón Ver -->
                                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalVer<?= $u['id_usuario']; ?>">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                        <!-- Botón Editar -->
                                        <button class="btn btn-warning btn-sm text-white" data-bs-toggle="modal" data-bs-target="#modalEditar<?= $u['id_usuario']; ?>">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <!-- Botón Eliminar -->
                                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalEliminar<?= $u['id_usuario']; ?>">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Incluimos los modales -->
                                <?php 
                                    include __DIR__ . "/../cruds/usuarios/ver.php"; 
                                    include __DIR__ . "/../cruds/usuarios/editar.php"; 
                                    include __DIR__ . "/../cruds/usuarios/borrar.php"; // 👈 archivo correcto
                                ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-muted">No hay usuarios registrados.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>

                </table>
            </div>
        </div>

        <!-- Paginación -->
        <nav aria-label="Paginación de usuarios">
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
document.getElementById("buscadorGlobal").addEventListener("keyup", function() {
    const query = this.value;

    fetch("../cruds/usuarios/buscarUsuarios.php?q=" + encodeURIComponent(query))
        .then(res => res.json())
        .then(data => {
            const tbody = document.getElementById("tablaUsuarios");
            tbody.innerHTML = "";

            if (data.length === 0) {
                tbody.innerHTML = `<tr><td colspan="6" class="text-muted">No se encontraron resultados.</td></tr>`;
                return;
            }

            data.forEach(u => {
                tbody.innerHTML += `
                    <tr>
                        <td>${u.id_usuario}</td>
                        <td>${u.nombre_usuario}</td>
                        <td>${u.email}</td>
                        <td>${u.rol}</td>
                        <td>
                            ${u.activo == 1 
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
