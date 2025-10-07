<!-- Modal Editar Rol -->
<div class="modal fade" id="modalEditar<?php echo $r['id_rol']; ?>" tabindex="-1" aria-labelledby="modalEditarLabel<?php echo $r['id_rol']; ?>" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Header -->
      <div class="modal-header bg-warning">
        <h5 class="modal-title text-dark" id="modalEditarLabel<?php echo $r['id_rol']; ?>">
          <i class="fas fa-edit"></i> Editar Rol
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <!-- Body -->
      <div class="modal-body">
        <form action="../cruds/roles/procesos.php" method="POST">
          <input type="hidden" name="accion" value="editar">
          <input type="hidden" name="id_rol" value="<?php echo $r['id_rol']; ?>">

          <!-- Nombre del Rol -->
          <div class="mb-3">
            <label for="nombre_rol_<?php echo $r['id_rol']; ?>" class="form-label">
              <i class="fas fa-user-shield"></i> Nombre del Rol
            </label>
            <input type="text" class="form-control" id="nombre_rol_<?php echo $r['id_rol']; ?>" 
                   name="nombre_rol" value="<?php echo htmlspecialchars($r['nombre_rol']); ?>" required>
          </div>

          <!-- Descripción -->
          <div class="mb-3">
            <label for="descripcion_<?php echo $r['id_rol']; ?>" class="form-label">
              <i class="fas fa-align-left"></i> Descripción
            </label>
            <textarea class="form-control" id="descripcion_<?php echo $r['id_rol']; ?>" 
                      name="descripcion" rows="3" required><?php echo htmlspecialchars($r['descripcion']); ?></textarea>
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
