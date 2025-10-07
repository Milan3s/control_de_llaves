<?php
require_once __DIR__ . "/../../controllers/EmpresaController.php";
$empresaController = new EmpresaController();
$empresas = $empresaController->listar();
?>

<div class="modal fade" id="modalNuevoEmpleado" tabindex="-1" aria-labelledby="modalNuevoEmpleadoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Encabezado -->
      <div class="modal-header">
        <h5 class="modal-title" id="modalNuevoEmpleadoLabel">
          <i class="fas fa-user-plus text-success"></i> Nuevo Empleado
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <!-- Cuerpo -->
      <div class="modal-body">
        <form action="../cruds/empleados/procesos.php" method="POST">

          <input type="hidden" name="accion" value="crear">

          <!-- Nombre -->
          <div class="mb-3">
            <label for="nombre" class="form-label">
              <i class="fas fa-user text-primary"></i> Nombre
            </label>
            <input type="text" class="form-control" name="nombre" required>
          </div>

          <!-- Apellidos -->
          <div class="mb-3">
            <label for="apellidos" class="form-label">
              <i class="fas fa-user-tag text-secondary"></i> Apellidos
            </label>
            <input type="text" class="form-control" name="apellidos" required>
          </div>

          <!-- Teléfono 1 -->
          <div class="mb-3">
            <label for="telefono1" class="form-label">
              <i class="fas fa-phone text-success"></i> Teléfono 1
            </label>
            <input type="text" class="form-control" name="telefono1" required>
          </div>

          <!-- Teléfono 2 -->
          <div class="mb-3">
            <label for="telefono2" class="form-label">
              <i class="fas fa-phone-alt text-success"></i> Teléfono 2
            </label>
            <input type="text" class="form-control" name="telefono2">
          </div>

          <!-- Empresa -->
          <div class="mb-3">
            <label for="id_empresa" class="form-label">
              <i class="fas fa-building text-info"></i> Empresa
            </label>
            <select class="form-select" name="id_empresa" required>
              <option value="">Seleccione una empresa...</option>
              <?php foreach ($empresas as $em): ?>
                <option value="<?= $em['id_empresa']; ?>">
                  <?= htmlspecialchars($em['nombre_empresa']); ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- Botones -->
          <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
              <i class="fas fa-times-circle"></i> Cancelar
            </button>
            <button type="submit" class="btn btn-success">
              <i class="fas fa-save"></i> Guardar
            </button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
