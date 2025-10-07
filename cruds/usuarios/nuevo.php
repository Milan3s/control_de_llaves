<div class="modal fade" id="modalNuevoUsuario" tabindex="-1" aria-labelledby="modalNuevoUsuarioLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      
      <!-- Header -->
      <div class="modal-header">
        <h5 class="modal-title" id="modalNuevoUsuarioLabel">
          <i class="fas fa-user-plus text-success"></i> Nuevo Usuario
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <!-- Body -->
      <div class="modal-body">
        <form action="../cruds/usuarios/procesos.php" method="POST">
            <input type="hidden" name="accion" value="registro_admin">
            
            <!-- Nombre de Usuario -->
            <div class="mb-3">
                <label for="nombre_usuario" class="form-label">
                  <i class="fas fa-user"></i> Nombre de Usuario
                </label>
                <input type="text" class="form-control" name="nombre_usuario" required>
            </div>

            <!-- Correo -->
            <div class="mb-3">
                <label for="email" class="form-label">
                  <i class="fas fa-envelope"></i> Correo
                </label>
                <input type="email" class="form-control" name="email" required>
            </div>

            <!-- Contraseña -->
            <div class="mb-3">
                <label for="password" class="form-label">
                  <i class="fas fa-lock"></i> Contraseña
                </label>
                <input type="password" class="form-control" name="password" required>
            </div>

            <!-- Footer con botones -->
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
