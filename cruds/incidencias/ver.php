<!-- Modal Ver Incidencia -->
<div class="modal fade" id="modalVer<?= $i['id_incidencia']; ?>" tabindex="-1" aria-labelledby="modalVerLabel<?= $i['id_incidencia']; ?>" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Header -->
      <div class="modal-header bg-info text-white">
        <h5 class="modal-title" id="modalVerLabel<?= $i['id_incidencia']; ?>">
          <i class="fas fa-exclamation-circle"></i> Detalles de la Incidencia
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <!-- Body -->
      <div class="modal-body">
        <ul class="list-group text-start">
          <li class="list-group-item">
            <i class="fas fa-hashtag text-primary"></i> <strong>ID:</strong> <?= htmlspecialchars($i['id_incidencia']); ?>
          </li>
          <li class="list-group-item">
            <i class="fas fa-key text-warning"></i> <strong>Llave:</strong> <?= htmlspecialchars($i['codigo_llave'] ?? 'N/A'); ?>
          </li>
          <li class="list-group-item">
            <i class="fas fa-user text-success"></i> <strong>Empleado:</strong> 
            <?= $i['nombre_empleado'] 
                ? htmlspecialchars($i['nombre_empleado'] . " " . $i['apellidos_empleado']) 
                : "<span class='text-muted'>No asignado</span>"; ?>
          </li>
          <li class="list-group-item">
            <i class="fas fa-exclamation-triangle text-danger"></i> <strong>Tipo:</strong> 
            <span class="badge 
              <?= $i['tipo_incidencia'] === 'perdida' ? 'bg-danger' : 
                 ($i['tipo_incidencia'] === 'daniada' ? 'bg-warning text-dark' : 
                 ($i['tipo_incidencia'] === 'retraso' ? 'bg-info text-dark' : 'bg-secondary')); ?>">
              <?= htmlspecialchars(ucfirst($i['tipo_incidencia'])); ?>
            </span>
          </li>
          <li class="list-group-item">
            <i class="fas fa-align-left text-muted"></i> <strong>Descripción:</strong> 
            <?= $i['descripcion'] 
                ? nl2br(htmlspecialchars($i['descripcion'])) 
                : "<span class='text-muted'>Sin descripción</span>"; ?>
          </li>
          <li class="list-group-item">
            <i class="fas fa-calendar-alt text-primary"></i> <strong>Fecha de Incidencia:</strong> 
            <?= $i['fecha_incidencia'] 
                ? date("d-m-Y H:i", strtotime($i['fecha_incidencia'])) 
                : "<span class='text-muted'>No registrada</span>"; ?>
          </li>
          <li class="list-group-item">
            <i class="fas fa-flag <?= $i['resuelta'] ? 'text-success' : 'text-danger'; ?>"></i> <strong>Estado:</strong> 
            <?= $i['resuelta'] 
                ? "<span class='badge bg-success'>Resuelta</span>" 
                : "<span class='badge bg-danger'>Pendiente</span>"; ?>
          </li>
        </ul>
      </div>

      <!-- Footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          <i class="fas fa-times"></i> Cerrar
        </button>
      </div>

    </div>
  </div>
</div>
