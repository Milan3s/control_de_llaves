<!-- Modal Ver Llave -->
<div class="modal fade" id="modalVer<?= $l['id_llave']; ?>" tabindex="-1" aria-labelledby="modalVerLabel<?= $l['id_llave']; ?>" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Header -->
      <div class="modal-header bg-info text-white">
        <h5 class="modal-title" id="modalVerLabel<?= $l['id_llave']; ?>">
          <i class="fas fa-key"></i> Detalles de la Llave
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <!-- Body -->
      <div class="modal-body">
        <ul class="list-group text-start">
          <li class="list-group-item">
            <i class="fas fa-hashtag text-secondary"></i> 
            <strong>ID:</strong> <?= htmlspecialchars($l['id_llave']); ?>
          </li>
          <li class="list-group-item">
            <i class="fas fa-barcode text-dark"></i> 
            <strong>Código:</strong> <?= htmlspecialchars($l['codigo_llave']); ?>
          </li>
          <li class="list-group-item">
            <i class="fas fa-align-left text-muted"></i> 
            <strong>Descripción:</strong> <?= htmlspecialchars($l['descripcion']); ?>
          </li>
          <li class="list-group-item">
            <i class="fas fa-user text-primary"></i> 
            <strong>Empleado:</strong> 
            <?= $l['nombre_empleado'] 
                ? htmlspecialchars($l['nombre_empleado'] . " " . $l['apellidos_empleado']) 
                : "<span class='text-muted'>No asignado</span>"; ?>
          </li>
          <li class="list-group-item">
            <i class="fas fa-building text-info"></i> 
            <strong>Empresa:</strong> 
            <?= $l['nombre_empresa'] 
                ? htmlspecialchars($l['nombre_empresa']) 
                : "<span class='text-muted'>No asignada</span>"; ?>
          </li>
          <li class="list-group-item">
            <i class="fas fa-clock text-warning"></i> 
            <strong>Hora de Recogida:</strong> 
            <?= $l['hora_cogido'] 
                ? date("d-m-Y H:i", strtotime($l['hora_cogido'])) 
                : "<span class='text-muted'>Pendiente</span>"; ?>
          </li>
          <li class="list-group-item">
            <i class="fas fa-clock text-success"></i> 
            <strong>Hora de Devolución:</strong> 
            <?= $l['hora_dejado'] 
                ? date("d-m-Y H:i", strtotime($l['hora_dejado'])) 
                : "<span class='text-muted'>Pendiente</span>"; ?>
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
