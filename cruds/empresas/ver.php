<!-- Modal Ver Empresa -->
<div class="modal fade" id="modalVer<?= $e['id_empresa']; ?>" tabindex="-1" aria-labelledby="modalVerLabel<?= $e['id_empresa']; ?>" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Header -->
      <div class="modal-header bg-info text-white">
        <h5 class="modal-title" id="modalVerLabel<?= $e['id_empresa']; ?>">
          <i class="fas fa-building"></i> Detalles de la Empresa
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <!-- Body -->
      <div class="modal-body">
        <ul class="list-group text-start">
          <li class="list-group-item">
            <i class="fas fa-hashtag text-secondary"></i>
            <strong>ID:</strong> <?= htmlspecialchars($e['id_empresa']); ?>
          </li>
          <li class="list-group-item">
            <i class="fas fa-building text-primary"></i>
            <strong>Nombre:</strong> <?= htmlspecialchars($e['nombre_empresa']); ?>
          </li>
          <li class="list-group-item">
            <i class="fas fa-map-marker-alt text-danger"></i>
            <strong>Dirección:</strong> <?= htmlspecialchars($e['direccion']); ?>
          </li>
          <li class="list-group-item">
            <i class="fas fa-phone text-success"></i>
            <strong>Teléfono:</strong> <?= htmlspecialchars($e['telefono']); ?>
          </li>
          <li class="list-group-item">
            <i class="fas fa-envelope text-warning"></i>
            <strong>Email:</strong> <?= htmlspecialchars($e['email']); ?>
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
