<!-- Modal Nuevo Rol -->
<div class="modal fade" id="modalNuevoRol" tabindex="-1" aria-labelledby="modalNuevoRolLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Header -->
      <div class="modal-header">
        <h5 class="modal-title" id="modalNuevoRolLabel">
          <i class="fas fa-plus-circle text-success"></i> Nuevo Rol
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <!-- Body -->
      <div class="modal-body">
        <form action="../cruds/roles/procesos.php" method="POST">
          <input type="hidden" name="accion" value="crear">

          <!-- Nombre del Rol -->
          <div class="mb-3">
            <label for="nombre_rol" class="form-label">
              <i class="fas fa-user-shield"></i> Nombre del Rol
            </label>
            <input type="text" class="form-control" name="nombre_rol" id="nombre_rol" required>
          </div>

          <!-- Descripción -->
          <div class="mb-3">
            <label for="descripcion" class="form-label">
              <i class="fas fa-align-left"></i> Descripción
            </label>
            <textarea class="form-control" name="descripcion" id="descripcion" rows="3" required></textarea>
          </div>

          <!-- Footer -->
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
