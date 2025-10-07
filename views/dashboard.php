<?php 
session_start();
if (!isset($_SESSION["id_usuario"])) {
    header("Location: login.php");
    exit;
}
?>
<?php include __DIR__ . "/../partials/header.php"; ?>
<?php include __DIR__ . "/../partials/navbar.php"; ?>

<div class="container">
    <div class="centrar-contenedor-dashboard">
        <!-- Título -->
        <h3 class="fw-bold text-dark mb-2">
            <i class="fas fa-key text-warning"></i> Control de Acceso de Llaves
        </h3>

        <!-- Separador -->
        <hr class="w-50 mb-3">

        <!-- Descripción -->
        <p class="text-muted mb-5 w-75">
            Este panel permite gestionar de manera centralizada el control de acceso de llaves: usuarios, roles, empresas,
            empleados, llaves e incidencias. Toda la información se organiza en un solo lugar para ofrecer seguridad y 
            trazabilidad en tiempo real.
        </p>

        <!-- Tarjetas -->
        <div class="row g-4 justify-content-center">
            <div class="col-md-4">
                <div class="card card-feature">
                    <div class="card-body">
                        <i class="fas fa-users fa-3x mb-3 text-primary"></i>
                        <h5 class="fw-bold">Usuarios</h5>
                        <p class="text-muted">Gestiona las cuentas de todos los usuarios que acceden al sistema.</p>
                        <a href="usuarios.php" class="btn btn-outline-primary btn-sm">Ver más</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-feature">
                    <div class="card-body">
                        <i class="fas fa-user-shield fa-3x mb-3 text-success"></i>
                        <h5 class="fw-bold">Roles</h5>
                        <p class="text-muted">Define permisos y responsabilidades para cada perfil.</p>
                        <a href="roles.php" class="btn btn-outline-success btn-sm">Ver más</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-feature">
                    <div class="card-body">
                        <i class="fas fa-building fa-3x mb-3 text-info"></i>
                        <h5 class="fw-bold">Empresas</h5>
                        <p class="text-muted">Administra los datos de las empresas que forman parte del sistema.</p>
                        <a href="empresas.php" class="btn btn-outline-info btn-sm">Ver más</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Segunda fila -->
        <div class="row g-4 mt-3 justify-content-center">
            <div class="col-md-4">
                <div class="card card-feature">
                    <div class="card-body">
                        <i class="fas fa-id-card fa-3x mb-3 text-warning"></i>
                        <h5 class="fw-bold">Empleados</h5>
                        <p class="text-muted">Registra y gestiona los empleados relacionados con las llaves.</p>
                        <a href="empleados.php" class="btn btn-outline-warning btn-sm">Ver más</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-feature">
                    <div class="card-body">
                        <i class="fas fa-key fa-3x mb-3 text-secondary"></i>
                        <h5 class="fw-bold">Llaves</h5>
                        <p class="text-muted">Controla el uso, asignación y devolución de todas las llaves.</p>
                        <a href="llaves.php" class="btn btn-outline-secondary btn-sm">Ver más</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-feature">
                    <div class="card-body">
                        <i class="fas fa-exclamation-triangle fa-3x mb-3 text-danger"></i>
                        <h5 class="fw-bold">Incidencias</h5>
                        <p class="text-muted">Supervisa y registra incidencias relacionadas con accesos.</p>
                        <a href="incidencias.php" class="btn btn-outline-danger btn-sm">Ver más</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . "/../partials/footer.php"; ?>
