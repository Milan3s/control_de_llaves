<?php
require_once __DIR__ . "/../../controllers/EmpresaController.php";
$empresaController = new EmpresaController();
$empresas = $empresaController->listar();
?>

<!-- Modal Editar Empleado -->
<div class="modal fade" id="modalEditar<?php echo $emp['id_empleado']; ?>" tabindex="-1" aria-labelledby="modalEditarLabel<?php echo $emp['id_empleado']; ?>" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Header -->
      <div class="modal-header bg-warning">
        <h5 class="modal-title text-dark" id="modalEditarLabel<?php echo $emp['id_empleado']; ?>">
          <i class="fas fa-user-edit"></i> Editar Empleado
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <!-- Body -->
      <div class="modal-body">
        <form action="../cruds/empleados/procesos.php" method="POST">
          <input type="hidden" name="accion" value="actualizar">
          <input type="hidden" name="id_empleado" value="<?php echo $emp['id_empleado']; ?>">

          <!-- Nombre -->
          <div class="mb-3">
            <label for="nombre_<?php echo $emp['id_empleado']; ?>" class="form-label">
              <i class="fas fa-user text-primary"></i> Nombre
            </label>
            <input type="text" class="form-control" 
                   id="nombre_<?php echo $emp['id_empleado']; ?>" 
                   name="nombre" 
                   value="<?php echo htmlspecialchars($emp['nombre']); ?>" required>
          </div>

          <!-- Apellidos -->
          <div class="mb-3">
            <label for="apellidos_<?php echo $emp['id_empleado']; ?>" class="form-label">
              <i class="fas fa-user-tag text-secondary"></i> Apellidos
            </label>
            <input type="text" class="form-control" 
                   id="apellidos_<?php echo $emp['id_empleado']; ?>" 
                   name="apellidos" 
                   value="<?php echo htmlspecialchars($emp['apellidos']); ?>" required>
          </div>

          <!-- Teléfono 1 -->
          <div class="mb-3">
            <label for="telefono1_<?php echo $emp['id_empleado']; ?>" class="form-label">
              <i class="fas fa-phone text-success"></i> Teléfono 1
            </label>
            <input type="text" class="form-control" 
                   id="telefono1_<?php echo $emp['id_empleado']; ?>" 
                   name="telefono1" 
                   value="<?php echo htmlspecialchars($emp['telefono1']); ?>" required>
          </div>

          <!-- Teléfono 2 -->
          <div class="mb-3">
            <label for="telefono2_<?php echo $emp['id_empleado']; ?>" class="form-label">
              <i class="fas fa-phone-alt text-success"></i> Teléfono 2
            </label>
            <input type="text" class="form-control" 
                   id="telefono2_<?php echo $emp['id_empleado']; ?>" 
                   name="telefono2" 
                   value="<?php echo htmlspecialchars($emp['telefono2']); ?>">
          </div>

          <!-- Empresa -->
          <div class="mb-3">
            <label for="id_empresa_<?php echo $emp['id_empleado']; ?>" class="form-label">
              <i class="fas fa-building text-info"></i> Empresa
            </label>
            <select class="form-select" id="id_empresa_<?php echo $emp['id_empleado']; ?>" name="id_empresa" required>
              <option value="">Seleccione una empresa...</option>
              <?php foreach ($empresas as $em): ?>
                <option value="<?= $em['id_empresa']; ?>" 
                  <?php if ($em['nombre_empresa'] == $emp['nombre_empresa']) echo "selected"; ?>>
                  <?= htmlspecialchars($em['nombre_empresa']); ?>
                </option>
              <?php endforeach; ?>
            </select>
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
