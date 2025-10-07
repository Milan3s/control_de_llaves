<!-- Modal Eliminar Usuario -->
<div class="modal fade" id="modalEliminar<?php echo $u['id_usuario']; ?>" tabindex="-1" aria-labelledby="modalEliminarLabel<?php echo $u['id_usuario']; ?>" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Header -->
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="modalEliminarLabel<?php echo $u['id_usuario']; ?>">
          <i class="fas fa-exclamation-triangle"></i> Confirmar Eliminación
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <!-- Body -->
      <div class="modal-body text-center">
        <p>
          <i class="fas fa-user-times text-danger"></i>
          ¿Estás seguro que deseas eliminar al usuario 
          <strong><?php echo htmlspecialchars($u['nombre_usuario']); ?></strong>?
        </p>
        <p class="text-muted">
          <i class="fas fa-ban"></i> <small>Esta acción no se puede deshacer.</small>
        </p>
      </div>

      <!-- Footer con formulario -->
      <div class="modal-footer">
        <form action="../cruds/usuarios/procesos.php" method="POST">
          <input type="hidden" name="accion" value="borrar">
          <input type="hidden" name="id_usuario" value="<?php echo $u['id_usuario']; ?>">

          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            <i class="fas fa-times-circle"></i> Cancelar
          </button>
          <button type="submit" class="btn btn-danger">
            <i class="fas fa-trash-alt"></i> Eliminar
          </button>
        </form>
      </div>

    </div>
  </div>
</div>
