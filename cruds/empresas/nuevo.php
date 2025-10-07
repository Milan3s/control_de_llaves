<div class="modal fade" id="modalNuevaEmpresa" tabindex="-1" aria-labelledby="modalNuevaEmpresaLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Encabezado -->
      <div class="modal-header">
        <h5 class="modal-title" id="modalNuevaEmpresaLabel">
          <i class="fas fa-building text-success"></i> Nueva Empresa
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <!-- Cuerpo -->
      <div class="modal-body">
        <form action="../cruds/empresas/procesos.php" method="POST">

          <input type="hidden" name="accion" value="crear">

          <!-- Nombre -->
          <div class="mb-3">
            <label for="nombre_empresa" class="form-label">
              <i class="fas fa-building text-primary"></i> Nombre de la Empresa
            </label>
            <input type="text" class="form-control" name="nombre_empresa" required>
          </div>

          <!-- Dirección -->
          <div class="mb-3">
            <label for="direccion" class="form-label">
              <i class="fas fa-map-marker-alt text-danger"></i> Dirección
            </label>
            <input type="text" class="form-control" name="direccion" required>
          </div>

          <!-- Teléfono -->
          <div class="mb-3">
            <label for="telefono" class="form-label">
              <i class="fas fa-phone text-success"></i> Teléfono
            </label>
            <input type="text" class="form-control" name="telefono" required>
          </div>

          <!-- Email -->
          <div class="mb-3">
            <label for="email" class="form-label">
              <i class="fas fa-envelope text-warning"></i> Correo Electrónico
            </label>
            <input type="email" class="form-control" name="email" required>
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
