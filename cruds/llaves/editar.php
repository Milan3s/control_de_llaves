<?php
require_once __DIR__ . "/../../controllers/LlaveController.php";

$llaveController = new LlaveController();

// Listas para selects
$empleados = $llaveController->listarEmpleados();
$empresas  = $llaveController->listarEmpresas();
?>

<!-- Modal Editar Llave -->
<div class="modal fade" id="modalEditar<?php echo $l['id_llave']; ?>" tabindex="-1" aria-labelledby="modalEditarLabel<?php echo $l['id_llave']; ?>" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Header -->
      <div class="modal-header bg-warning">
        <h5 class="modal-title text-dark" id="modalEditarLabel<?php echo $l['id_llave']; ?>">
          <i class="fas fa-edit"></i> Editar Llave
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <!-- Body -->
      <div class="modal-body">
        <form action="../cruds/llaves/procesos.php" method="POST">
          <input type="hidden" name="accion" value="actualizar">
          <input type="hidden" name="id_llave" value="<?php echo $l['id_llave']; ?>">

          <!-- Código de Llave -->
          <div class="mb-3">
            <label for="codigo_llave_<?php echo $l['id_llave']; ?>" class="form-label">
              <i class="fas fa-barcode text-dark"></i> Código de Llave
            </label>
            <input type="text" class="form-control" 
                   id="codigo_llave_<?php echo $l['id_llave']; ?>" 
                   name="codigo_llave" 
                   value="<?php echo htmlspecialchars($l['codigo_llave']); ?>" required>
          </div>

          <!-- Descripción -->
          <div class="mb-3">
            <label for="descripcion_<?php echo $l['id_llave']; ?>" class="form-label">
              <i class="fas fa-align-left text-muted"></i> Descripción
            </label>
            <textarea class="form-control" id="descripcion_<?php echo $l['id_llave']; ?>" name="descripcion" rows="2"><?php echo htmlspecialchars($l['descripcion']); ?></textarea>
          </div>

          <!-- Empleado -->
          <div class="mb-3">
            <label for="id_empleado_<?php echo $l['id_llave']; ?>" class="form-label">
              <i class="fas fa-user text-primary"></i> Empleado
            </label>
            <select class="form-select" id="id_empleado_<?php echo $l['id_llave']; ?>" name="id_empleado">
              <option value="">-- Sin asignar --</option>
              <?php foreach ($empleados as $emp): ?>
                <option value="<?= $emp['id_empleado']; ?>" 
                  <?php if ($emp['id_empleado'] == $l['id_empleado']) echo "selected"; ?>>
                  <?= htmlspecialchars($emp['nombre'] . " " . $emp['apellidos']); ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- Empresa -->
          <div class="mb-3">
            <label for="id_empresa_<?php echo $l['id_llave']; ?>" class="form-label">
              <i class="fas fa-building text-info"></i> Empresa
            </label>
            <select class="form-select" id="id_empresa_<?php echo $l['id_llave']; ?>" name="id_empresa" required>
              <option value="">Seleccione una empresa...</option>
              <?php foreach ($empresas as $em): ?>
                <option value="<?= $em['id_empresa']; ?>" 
                  <?php if ($em['id_empresa'] == $l['id_empresa']) echo "selected"; ?>>
                  <?= htmlspecialchars($em['nombre_empresa']); ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- Hora Cogido -->
          <div class="mb-3">
            <label for="hora_cogido_<?php echo $l['id_llave']; ?>" class="form-label">
              <i class="fas fa-clock text-warning"></i> Hora de Recogida
            </label>
            <input type="datetime-local" class="form-control" 
                   id="hora_cogido_<?php echo $l['id_llave']; ?>" 
                   name="hora_cogido" 
                   value="<?php echo $l['hora_cogido'] ? date('Y-m-d\TH:i', strtotime($l['hora_cogido'])) : ''; ?>">
          </div>

          <!-- Hora Dejado -->
          <div class="mb-3">
            <label for="hora_dejado_<?php echo $l['id_llave']; ?>" class="form-label">
              <i class="fas fa-clock text-success"></i> Hora de Devolución
            </label>
            <input type="datetime-local" class="form-control" 
                   id="hora_dejado_<?php echo $l['id_llave']; ?>" 
                   name="hora_dejado" 
                   value="<?php echo $l['hora_dejado'] ? date('Y-m-d\TH:i', strtotime($l['hora_dejado'])) : ''; ?>">
          </div>

          <!-- Footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
              <i class="fas fa-times-circle"></i> Cancelar
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
