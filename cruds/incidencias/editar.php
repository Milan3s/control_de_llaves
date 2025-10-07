<?php
require_once __DIR__ . "/../../controllers/IncidenciaController.php";

$incidenciaController = new IncidenciaController();

// Listas para selects
$llaves    = $incidenciaController->listarLlaves();
$empleados = $incidenciaController->listarEmpleados();
?>

<!-- Modal Editar Incidencia -->
<div class="modal fade" id="modalEditar<?= $i['id_incidencia']; ?>" tabindex="-1" aria-labelledby="modalEditarLabel<?= $i['id_incidencia']; ?>" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Header -->
      <div class="modal-header bg-warning">
        <h5 class="modal-title text-dark" id="modalEditarLabel<?= $i['id_incidencia']; ?>">
          <i class="fas fa-edit"></i> Editar Incidencia
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <!-- Body -->
      <div class="modal-body">
        <form action="../cruds/incidencias/procesos.php" method="POST">
          <input type="hidden" name="accion" value="actualizar">
          <input type="hidden" name="id_incidencia" value="<?= $i['id_incidencia']; ?>">

          <!-- Llave -->
          <div class="mb-3">
            <label for="id_llave_<?= $i['id_incidencia']; ?>" class="form-label">
              <i class="fas fa-key text-secondary"></i> Llave
            </label>
            <select class="form-select" id="id_llave_<?= $i['id_incidencia']; ?>" name="id_llave" required>
              <option value="">Seleccione una llave...</option>
              <?php foreach ($llaves as $l): ?>
                <option value="<?= $l['id_llave']; ?>" 
                  <?= $l['id_llave'] == $i['id_llave'] ? "selected" : ""; ?>>
                  <?= htmlspecialchars($l['codigo_llave']); ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- Empleado -->
          <div class="mb-3">
            <label for="id_empleado_<?= $i['id_incidencia']; ?>" class="form-label">
              <i class="fas fa-user text-primary"></i> Empleado
            </label>
            <select class="form-select" id="id_empleado_<?= $i['id_incidencia']; ?>" name="id_empleado" required>
              <option value="">Seleccione un empleado...</option>
              <?php foreach ($empleados as $emp): ?>
                <option value="<?= $emp['id_empleado']; ?>" 
                  <?= $emp['id_empleado'] == $i['id_empleado'] ? "selected" : ""; ?>>
                  <?= htmlspecialchars($emp['nombre'] . " " . $emp['apellidos']); ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- Tipo de Incidencia -->
          <div class="mb-3">
            <label for="tipo_incidencia_<?= $i['id_incidencia']; ?>" class="form-label">
              <i class="fas fa-list text-warning"></i> Tipo de Incidencia
            </label>
            <select class="form-select" id="tipo_incidencia_<?= $i['id_incidencia']; ?>" name="tipo_incidencia" required>
              <option value="perdida" <?= $i['tipo_incidencia'] === 'perdida' ? 'selected' : ''; ?>>Pérdida</option>
              <option value="daniada" <?= $i['tipo_incidencia'] === 'daniada' ? 'selected' : ''; ?>>Dañada</option>
              <option value="retraso" <?= $i['tipo_incidencia'] === 'retraso' ? 'selected' : ''; ?>>Retraso</option>
              <option value="otra"    <?= $i['tipo_incidencia'] === 'otra'    ? 'selected' : ''; ?>>Otra</option>
            </select>
          </div>

          <!-- Descripción -->
          <div class="mb-3">
            <label for="descripcion_<?= $i['id_incidencia']; ?>" class="form-label">
              <i class="fas fa-align-left text-info"></i> Descripción
            </label>
            <textarea class="form-control" id="descripcion_<?= $i['id_incidencia']; ?>" name="descripcion" rows="3"><?= htmlspecialchars($i['descripcion']); ?></textarea>
          </div>

          <!-- Estado -->
          <div class="mb-3">
            <label for="resuelta_<?= $i['id_incidencia']; ?>" class="form-label">
              <i class="fas fa-flag text-success"></i> Estado
            </label>
            <select class="form-select" id="resuelta_<?= $i['id_incidencia']; ?>" name="resuelta" required>
              <option value="0" <?= $i['resuelta'] == 0 ? 'selected' : ''; ?>>Pendiente</option>
              <option value="1" <?= $i['resuelta'] == 1 ? 'selected' : ''; ?>>Resuelta</option>
            </select>
          </div>

          <!-- Footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
              <i class="fas fa-times"></i> Cancelar
            </button>
            <button type="submit" class="btn btn-warning text-white">
              <i class="fas fa-save"></i> Guardar Cambios
            </button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
