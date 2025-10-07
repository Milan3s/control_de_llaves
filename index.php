<?php include __DIR__ . "/partials/header.php"; ?>

<!-- Contenedor principal centrado -->
<div class="d-flex align-items-center justify-content-center vh-100 bg-light">
  <div class="text-center">

    <!-- Título -->
    <h1 class="display-4 fw-bold text-primary mb-3">
      <i class="fas fa-key text-warning"></i> Control de Llaves
    </h1>
    <p class="lead text-muted mb-4">
      Una plataforma sencilla y potente para gestionar y controlar las llaves de tu empresa.
    </p>

    <!-- Tarjetas -->
    <div class="row justify-content-center mb-4">
      <div class="col-md-5 mb-3">
        <div class="card h-100 shadow border-0">
          <div class="card-body text-center">
            <i class="fas fa-lock display-3 text-info"></i>
            <h4 class="mt-3 text-dark">Gestión de Llaves</h4>
            <p class="text-muted">
              Registra qué empleado tiene cada llave, cuándo la retiró y cuándo debe devolverla.
            </p>
          </div>
        </div>
      </div>

      <div class="col-md-5 mb-3">
        <div class="card h-100 shadow border-0">
          <div class="card-body text-center">
            <i class="fas fa-user-shield display-3 text-success"></i>
            <h4 class="mt-3 text-dark">Control de Accesos</h4>
            <p class="text-muted">
              Supervisa el uso de llaves críticas y obtén un historial de accesos en tiempo real.
            </p>
          </div>
        </div>
      </div>
    </div>

    <!-- Botón debajo de las tarjetas -->
    <a href="views/login.php" class="btn btn-gradient btn-lg px-5 py-3">
      <i class="fas fa-sign-in-alt"></i> Entrar a la aplicación
    </a>

  </div>
</div>

<!-- FontAwesome -->
<script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>

<?php include __DIR__ . "/partials/footer.php"; ?>
