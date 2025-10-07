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
            <div class="card-header bg-primary text-white text-center">
                <h4><i class="fas fa-key"></i> Iniciar Sesión</h4>
            </div>
            <div class="card-body">
                <?php if (isset($_GET["msg"]) && $_GET["msg"] == "registrado"): ?>
                    <div class="alert alert-success text-center">
                        Registro exitoso, ya puedes iniciar sesión.
                    </div>
                <?php endif; ?>

                <?php if (isset($_GET["error"]) && $_GET["error"] == "login"): ?>
                    <div class="alert alert-danger text-center">
                        Usuario o contraseña incorrectos.
                    </div>
                <?php endif; ?>

                <!-- ✅ Ahora apunta al procesador correcto -->
                <form action="../cruds/usuarios/login_procesar.php" method="POST">
                    <input type="hidden" name="accion" value="login">

                    <div class="mb-3">
                        <label for="nombre_usuario" class="form-label">
                            <i class="fas fa-user"></i> Usuario
                        </label>
                        <input type="text" id="nombre_usuario" name="nombre_usuario" class="form-control" placeholder="Ingresa tu usuario" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">
                            <i class="fas fa-lock"></i> Contraseña
                        </label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="********" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-sign-in-alt"></i> Ingresar
                        </button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center">
                <small>¿No tienes cuenta? <a href="registro.php" class="text-decoration-none">Registrarse</a></small>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . "/../partials/footer.php"; ?>
