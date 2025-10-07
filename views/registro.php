<?php 
session_start();
if (isset($_SESSION["id_usuario"])) {
    header("Location: dashboard.php");
    exit;
}
?>
<?php include __DIR__ . "/../partials/header.php"; ?>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="col-md-5">
        <div class="card shadow-lg">
            <div class="card-header bg-success text-white text-center">
                <h4><i class="fas fa-user-plus"></i> Registrar Usuario</h4>
            </div>
            <div class="card-body">

                <!-- Mensajes de éxito o error -->
                <?php if (isset($_SESSION["msg_success"])): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= $_SESSION["msg_success"]; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                    </div>
                    <?php unset($_SESSION["msg_success"]); ?>
                <?php endif; ?>

                <?php if (isset($_SESSION["msg_error"])): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= $_SESSION["msg_error"]; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                    </div>
                    <?php unset($_SESSION["msg_error"]); ?>
                <?php endif; ?>

                <form action="../cruds/usuarios/procesos.php" method="POST">
                   <input type="hidden" name="accion" value="registro_login">

                    <div class="mb-3">
                        <label for="nombre_usuario" class="form-label">
                            <i class="fas fa-user"></i> Nombre de usuario
                        </label>
                        <input type="text" id="nombre_usuario" name="nombre_usuario" class="form-control" placeholder="Ingresa tu usuario" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope"></i> Email
                        </label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="correo@ejemplo.com" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">
                            <i class="fas fa-lock"></i> Contraseña
                        </label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="********" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Registrar
                        </button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center">
                <small>¿Ya tienes cuenta? <a href="login.php" class="text-decoration-none">Iniciar sesión</a></small>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . "/../partials/footer.php"; ?>
