<!-- Modal Ver Rol -->
<div class="modal fade" id="modalVer<?= $r['id_rol']; ?>" tabindex="-1" aria-labelledby="modalVerLabel<?= $r['id_rol']; ?>" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Header -->
      <div class="modal-header bg-info text-white">
        <h5 class="modal-title" id="modalVerLabel<?= $r['id_rol']; ?>">
          <i class="fas fa-eye"></i> Detalles del Rol
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <!-- Body -->
      <div class="modal-body">
        <ul class="list-group text-start">
          <li class="list-group-item">
            <i class="fas fa-hashtag text-secondary"></i> 
            <strong>ID:</strong> <?= htmlspecialchars($r['id_rol']); ?>
          </li>
          <li class="list-group-item">
            <i class="fas fa-user-shield text-primary"></i> 
            <strong>Nombre Rol:</strong> <?= htmlspecialchars($r['nombre_rol']); ?>
          </li>
          <li class="list-group-item">
            <i class="fas fa-align-left text-muted"></i> 
            <strong>Descripción:</strong> <?= htmlspecialchars($r['descripcion']); ?>
          </li>
        </ul>
      </div>

      <!-- Footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          <i class="fas fa-times-circle"></i> Cerrar
        </button>
      </div>

    </div>
  </div>
</div>
