<?php
require_once __DIR__ . "/../../controllers/IncidenciaController.php";

$incidenciaController = new IncidenciaController();

// Listas para selects
$llaves    = $incidenciaController->listarLlaves();
$empleados = $incidenciaController->listarEmpleados();
?>

<div class="modal fade" id="modalNuevaIncidencia" tabindex="-1" aria-labelledby="modalNuevaIncidenciaLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Header -->
      <div class="modal-header">
        <h5 class="modal-title" id="modalNuevaIncidenciaLabel">
          <i class="fas fa-exclamation-circle text-danger"></i> Nueva Incidencia
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Body -->
      <div class="modal-body">
        <form action="../cruds/incidencias/procesos.php" method="POST">
          <input type="hidden" name="accion" value="crear">

          <!-- Llave -->
          <div class="mb-3">
            <label for="id_llave" class="form-label">
              <i class="fas fa-key text-secondary"></i> Llave
            </label>
            <select class="form-select" name="id_llave" required>
              <option value="">Seleccione una llave...</option>
              <?php foreach ($llaves as $l): ?>
                <option value="<?= $l['id_llave']; ?>">
                  <?= htmlspecialchars($l['codigo_llave'] . " - " . $l['descripcion']); ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- Empleado -->
          <div class="mb-3">
            <label for="id_empleado" class="form-label">
              <i class="fas fa-user text-primary"></i> Empleado
            </label>
            <select class="form-select" name="id_empleado" required>
              <option value="">Seleccione un empleado...</option>
              <?php foreach ($empleados as $emp): ?>
                <option value="<?= $emp['id_empleado']; ?>">
                  <?= htmlspecialchars($emp['nombre'] . " " . $emp['apellidos']); ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- Tipo Incidencia -->
          <div class="mb-3">
            <label for="tipo_incidencia" class="form-label">
              <i class="fas fa-list text-warning"></i> Tipo de Incidencia
            </label>
            <select class="form-select" name="tipo_incidencia" required>
              <option value="">Seleccione...</option>
              <option value="perdida">Pérdida</option>
              <option value="daniada">Dañada</option>
              <option value="retraso">Retraso</option>
              <option value="otra">Otra</option>
            </select>
          </div>

          <!-- Descripción -->
          <div class="mb-3">
            <label for="descripcion" class="form-label">
              <i class="fas fa-align-left text-info"></i> Descripción
            </label>
            <textarea class="form-control" name="descripcion" rows="3"></textarea>
          </div>

          <!-- Footer -->
          <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
              <i class="fas fa-times"></i> Cancelar
            </button>
            <button type="submit" class="btn btn-danger">
              <i class="fas fa-save"></i> Registrar
            </button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
