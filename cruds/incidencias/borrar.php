<!-- Modal Eliminar Incidencia -->
<div class="modal fade" id="modalEliminar<?= $i['id_incidencia']; ?>" tabindex="-1" aria-labelledby="modalEliminarLabel<?= $i['id_incidencia']; ?>" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Header -->
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="modalEliminarLabel<?= $i['id_incidencia']; ?>">
          <i class="fas fa-exclamation-triangle"></i> Confirmar Eliminación
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <!-- Body -->
      <div class="modal-body text-center">
        <p>
          <i class="fas fa-exclamation-circle text-danger fa-lg"></i> 
          ¿Estás seguro que deseas eliminar la incidencia 
          <strong>#<?= htmlspecialchars($i['id_incidencia']); ?></strong> 
          de la llave <strong><?= htmlspecialchars($i['codigo_llave']); ?></strong>?
        </p>
        <p class="text-muted">
          <small><i class="fas fa-ban"></i> Esta acción no se puede deshacer.</small>
        </p>
      </div>

      <!-- Footer con formulario -->
      <div class="modal-footer">
        <form action="../cruds/incidencias/procesos.php" method="POST">
          <input type="hidden" name="accion" value="eliminar">
          <input type="hidden" name="id_incidencia" value="<?= $i['id_incidencia']; ?>">
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
