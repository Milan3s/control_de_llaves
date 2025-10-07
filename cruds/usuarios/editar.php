<!-- Modal Editar Usuario -->
<div class="modal fade" id="modalEditar<?php echo $u['id_usuario']; ?>" tabindex="-1" aria-labelledby="modalEditarLabel<?php echo $u['id_usuario']; ?>" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Header -->
      <div class="modal-header bg-warning">
        <h5 class="modal-title text-dark" id="modalEditarLabel<?php echo $u['id_usuario']; ?>">
          <i class="fas fa-user-edit"></i> Editar Usuario
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <!-- Body -->
      <div class="modal-body">
        <form action="../cruds/usuarios/procesos.php" method="POST">
          <input type="hidden" name="accion" value="actualizar">
          <input type="hidden" name="id_usuario" value="<?php echo $u['id_usuario']; ?>">

          <!-- Nombre de Usuario -->
          <div class="mb-3">
            <label for="nombre_usuario_<?php echo $u['id_usuario']; ?>" class="form-label">
              <i class="fas fa-user"></i> Nombre de Usuario
            </label>
            <input type="text" class="form-control" id="nombre_usuario_<?php echo $u['id_usuario']; ?>" 
                   name="nombre_usuario" value="<?php echo htmlspecialchars($u['nombre_usuario']); ?>" required>
          </div>

          <!-- Email -->
          <div class="mb-3">
            <label for="email_<?php echo $u['id_usuario']; ?>" class="form-label">
              <i class="fas fa-envelope"></i> Correo
            </label>
            <input type="email" class="form-control" id="email_<?php echo $u['id_usuario']; ?>" 
                   name="email" value="<?php echo htmlspecialchars($u['email']); ?>" required>
          </div>

          <!-- Rol -->
          <div class="mb-3">
            <label for="id_rol_<?php echo $u['id_usuario']; ?>" class="form-label">
              <i class="fas fa-user-shield"></i> Rol
            </label>
            <select class="form-select" id="id_rol_<?php echo $u['id_usuario']; ?>" name="id_rol" required>
              <option value="1" <?php if ($u['rol'] == 'Admin') echo 'selected'; ?>>Administrador</option>
              <option value="2" <?php if ($u['rol'] == 'Editor') echo 'selected'; ?>>Editor</option>
              <option value="3" <?php if ($u['rol'] == 'Consulta') echo 'selected'; ?>>Consulta</option>
            </select>
          </div>

          <!-- Activo -->
          <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" 
                   id="activo_<?php echo $u['id_usuario']; ?>" 
                   name="activo" <?php echo ($u['activo']) ? 'checked' : ''; ?>>
            <label class="form-check-label" for="activo_<?php echo $u['id_usuario']; ?>">
              <i class="fas fa-toggle-on"></i> Activo
            </label>
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
