<!-- Modal Editar Empresa -->
<div class="modal fade" id="modalEditar<?php echo $e['id_empresa']; ?>" tabindex="-1" aria-labelledby="modalEditarLabel<?php echo $e['id_empresa']; ?>" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Header -->
      <div class="modal-header bg-warning">
        <h5 class="modal-title text-dark" id="modalEditarLabel<?php echo $e['id_empresa']; ?>">
          <i class="fas fa-edit"></i> Editar Empresa
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <!-- Body -->
      <div class="modal-body">
        <form action="../cruds/empresas/procesos.php" method="POST">
          <input type="hidden" name="accion" value="actualizar">
          <input type="hidden" name="id_empresa" value="<?php echo $e['id_empresa']; ?>">

          <!-- Nombre -->
          <div class="mb-3">
            <label for="nombre_empresa_<?php echo $e['id_empresa']; ?>" class="form-label">
              <i class="fas fa-building"></i> Nombre de la Empresa
            </label>
            <input type="text" class="form-control" 
                   id="nombre_empresa_<?php echo $e['id_empresa']; ?>" 
                   name="nombre_empresa" 
                   value="<?php echo htmlspecialchars($e['nombre_empresa']); ?>" required>
          </div>

          <!-- Dirección -->
          <div class="mb-3">
            <label for="direccion_<?php echo $e['id_empresa']; ?>" class="form-label">
              <i class="fas fa-map-marker-alt"></i> Dirección
            </label>
            <input type="text" class="form-control" 
                   id="direccion_<?php echo $e['id_empresa']; ?>" 
                   name="direccion" 
                   value="<?php echo htmlspecialchars($e['direccion']); ?>" required>
          </div>

          <!-- Teléfono -->
          <div class="mb-3">
            <label for="telefono_<?php echo $e['id_empresa']; ?>" class="form-label">
              <i class="fas fa-phone"></i> Teléfono
            </label>
            <input type="text" class="form-control" 
                   id="telefono_<?php echo $e['id_empresa']; ?>" 
                   name="telefono" 
                   value="<?php echo htmlspecialchars($e['telefono']); ?>" required>
          </div>

          <!-- Email -->
          <div class="mb-3">
            <label for="email_<?php echo $e['id_empresa']; ?>" class="form-label">
              <i class="fas fa-envelope"></i> Correo Electrónico
            </label>
            <input type="email" class="form-control" 
                   id="email_<?php echo $e['id_empresa']; ?>" 
                   name="email" 
                   value="<?php echo htmlspecialchars($e['email']); ?>" required>
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
