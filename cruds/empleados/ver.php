<!-- Modal Ver Empleado -->
<div class="modal fade" id="modalVer<?= $emp['id_empleado']; ?>" tabindex="-1" aria-labelledby="modalVerLabel<?= $emp['id_empleado']; ?>" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Header -->
      <div class="modal-header bg-info text-white">
        <h5 class="modal-title" id="modalVerLabel<?= $emp['id_empleado']; ?>">
          <i class="fas fa-id-card"></i> Detalles del Empleado
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <!-- Body -->
      <div class="modal-body">
        <ul class="list-group text-start">
          <li class="list-group-item">
            <i class="fas fa-hashtag text-secondary"></i> <strong>ID:</strong> <?= htmlspecialchars($emp['id_empleado']); ?>
          </li>
          <li class="list-group-item">
            <i class="fas fa-user text-primary"></i> <strong>Nombre:</strong> <?= htmlspecialchars($emp['nombre']); ?>
          </li>
          <li class="list-group-item">
            <i class="fas fa-user-tag text-secondary"></i> <strong>Apellidos:</strong> <?= htmlspecialchars($emp['apellidos']); ?>
          </li>
          <li class="list-group-item">
            <i class="fas fa-phone text-success"></i> <strong>Teléfono 1:</strong> <?= htmlspecialchars($emp['telefono1']); ?>
          </li>
          <li class="list-group-item">
            <i class="fas fa-phone-alt text-success"></i> <strong>Teléfono 2:</strong> 
            <?= !empty($emp['telefono2']) ? htmlspecialchars($emp['telefono2']) : "<span class='text-muted'>-</span>"; ?>
          </li>
          <li class="list-group-item">
            <i class="fas fa-building text-info"></i> <strong>Empresa:</strong> <?= htmlspecialchars($emp['nombre_empresa']); ?>
          </li>
          <li class="list-group-item">
            <i class="fas fa-calendar-alt text-warning"></i> <strong>Fecha de Registro:</strong> <?= (new DateTime($emp['fecha_registro']))->format("d-m-Y H:i"); ?>
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
