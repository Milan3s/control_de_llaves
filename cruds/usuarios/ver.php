<!-- Modal Ver Usuario -->
<div class="modal fade" id="modalVer<?= $u['id_usuario']; ?>" tabindex="-1" aria-labelledby="modalVerLabel<?= $u['id_usuario']; ?>" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Header -->
      <div class="modal-header bg-info text-white">
        <h5 class="modal-title" id="modalVerLabel<?= $u['id_usuario']; ?>">
          <i class="fas fa-user-circle"></i> Detalles del Usuario
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <!-- Body -->
      <div class="modal-body">
        <ul class="list-group text-start">
          <li class="list-group-item">
            <i class="fas fa-hashtag text-primary"></i> 
            <strong>ID:</strong> <?= htmlspecialchars($u['id_usuario']); ?>
          </li>
          <li class="list-group-item">
            <i class="fas fa-user text-success"></i> 
            <strong>Usuario:</strong> <?= htmlspecialchars($u['nombre_usuario']); ?>
          </li>
          <li class="list-group-item">
            <i class="fas fa-envelope text-warning"></i> 
            <strong>Email:</strong> <?= htmlspecialchars($u['email']); ?>
          </li>
          <li class="list-group-item">
            <i class="fas fa-user-shield text-info"></i> 
            <strong>Rol:</strong> <?= htmlspecialchars($u['rol']); ?>
          </li>
          <li class="list-group-item">
            <i class="fas fa-toggle-on text-secondary"></i> 
            <strong>Activo:</strong>
            <?php if ($u['activo']): ?>
              <span class="badge bg-success"><i class="fas fa-check-circle"></i> Sí</span>
            <?php else: ?>
              <span class="badge bg-danger"><i class="fas fa-times-circle"></i> No</span>
            <?php endif; ?>
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
