<!-- Modal Eliminar Llave -->
<div class="modal fade" id="modalEliminar<?php echo $l['id_llave']; ?>" tabindex="-1" aria-labelledby="modalEliminarLabel<?php echo $l['id_llave']; ?>" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Header -->
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="modalEliminarLabel<?php echo $l['id_llave']; ?>">
          <i class="fas fa-exclamation-triangle"></i> Confirmar Eliminación
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <!-- Body -->
      <div class="modal-body text-center">
        <p>
          <i class="fas fa-key text-danger"></i> 
          ¿Estás seguro que deseas eliminar la llave 
          <strong><?php echo htmlspecialchars($l['codigo_llave']); ?></strong>?
        </p>
        <p class="text-muted">
          <small><i class="fas fa-exclamation-circle"></i> Esta acción no se puede deshacer.</small>
        </p>
      </div>

      <!-- Footer con formulario -->
      <div class="modal-footer">
        <form action="../cruds/llaves/procesos.php" method="POST">
          <input type="hidden" name="accion" value="eliminar">
          <input type="hidden" name="id_llave" value="<?php echo $l['id_llave']; ?>">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            <i class="fas fa-times"></i> Cancelar
          </button>
          <button type="submit" class="btn btn-danger">
            <i class="fas fa-trash-alt"></i> Eliminar
          </button>
        </form>
      </div>

    </div>
  </div>
</div>
