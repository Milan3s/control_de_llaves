<?php
require_once __DIR__ . "/../../controllers/LlaveController.php";

$llaveController = new LlaveController();

// Listas para los selects
$empleados = $llaveController->listarEmpleados();
$empresas  = $llaveController->listarEmpresas();
?>

<div class="modal fade" id="modalNuevaLlave" tabindex="-1" aria-labelledby="modalNuevaLlaveLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Encabezado -->
      <div class="modal-header">
        <h5 class="modal-title" id="modalNuevaLlaveLabel">
          <i class="fas fa-key text-success"></i> Nueva Llave
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <!-- Cuerpo -->
      <div class="modal-body">
        <form action="../cruds/llaves/procesos.php" method="POST">

          <input type="hidden" name="accion" value="crear">

          <!-- Código de Llave -->
          <div class="mb-3">
            <label for="codigo_llave" class="form-label">
              <i class="fas fa-barcode text-dark"></i> Código de Llave
            </label>
            <input type="text" class="form-control" name="codigo_llave" required>
          </div>

          <!-- Descripción -->
          <div class="mb-3">
            <label for="descripcion" class="form-label">
              <i class="fas fa-align-left text-muted"></i> Descripción
            </label>
            <textarea class="form-control" name="descripcion" rows="2"></textarea>
          </div>

          <!-- Empleado -->
          <div class="mb-3">
            <label for="id_empleado" class="form-label">
              <i class="fas fa-user text-primary"></i> Empleado
            </label>
            <select class="form-select" name="id_empleado">
              <option value="">-- Sin asignar --</option>
              <?php foreach ($empleados as $emp): ?>
                <option value="<?= $emp['id_empleado']; ?>">
                  <?= htmlspecialchars($emp['nombre'] . " " . $emp['apellidos']); ?>
                </option>
              <?php endforeach; ?>
            </select>
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

          <!-- Hora Cogido -->
          <div class="mb-3">
            <label for="hora_cogido" class="form-label">
              <i class="fas fa-clock text-warning"></i> Hora de Recogida
            </label>
            <input type="datetime-local" class="form-control" name="hora_cogido">
          </div>

          <!-- Hora Dejado -->
          <div class="mb-3">
            <label for="hora_dejado" class="form-label">
              <i class="fas fa-clock text-success"></i> Hora de Devolución
            </label>
            <input type="datetime-local" class="form-control" name="hora_dejado">
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
