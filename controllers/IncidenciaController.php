<?php
require_once __DIR__ . "/../config/Conexion.php";
require_once __DIR__ . "/../models/Incidencia.php";

class IncidenciaController {
    private $pdo;

    public function __construct() {
        $conexion = new Conexion();
        $this->pdo = $conexion->conectar();
    }

    // ====== CREATE ======
    public function crear(Incidencia $incidencia) {
        $sql = "INSERT INTO incidencias 
                (id_llave, id_empleado, tipo_incidencia, descripcion, fecha_incidencia, resuelta) 
                VALUES (:id_llave, :id_empleado, :tipo_incidencia, :descripcion, :fecha_incidencia, :resuelta)";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ":id_llave"         => $incidencia->getIdLlave(),
            ":id_empleado"      => $incidencia->getIdEmpleado(),
            ":tipo_incidencia"  => $incidencia->getTipoIncidencia(),
            ":descripcion"      => $incidencia->getDescripcion(),
            ":fecha_incidencia" => $incidencia->getFechaIncidencia(),
            ":resuelta"         => $incidencia->getResuelta() ?? 0
        ]);
    }

    // ====== READ (buscar por término) ======
    public function buscar($termino) {
        $termino = trim($termino);

        $sql = "SELECT i.id_incidencia, 
                    i.tipo_incidencia, 
                    i.descripcion, 
                    i.fecha_incidencia, 
                    i.resuelta,
                    l.codigo_llave,
                    e.nombre AS nombre_empleado, 
                    e.apellidos AS apellidos_empleado
                FROM incidencias i
                INNER JOIN llaves l ON i.id_llave = l.id_llave
                INNER JOIN empleados e ON i.id_empleado = e.id_empleado";

        if (!empty($termino)) {
            $sql .= " WHERE i.tipo_incidencia LIKE :termino
                    OR i.descripcion LIKE :termino
                    OR l.codigo_llave LIKE :termino
                    OR e.nombre LIKE :termino
                    OR e.apellidos LIKE :termino";
        }

        $sql .= " ORDER BY i.fecha_incidencia ASC";

        $stmt = $this->pdo->prepare($sql);

        if (!empty($termino)) {
            $stmt->execute([":termino" => "%" . $termino . "%"]);
        } else {
            $stmt->execute();
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // ====== READ con paginación ======
    public function listarPaginado($pagina = 1, $por_pagina = 10) {
        $offset = ($pagina - 1) * $por_pagina;

        $sql = "SELECT i.id_incidencia, 
                       i.tipo_incidencia, 
                       i.id_llave,
                       i.id_empleado,
                       i.descripcion, 
                       i.fecha_incidencia, 
                       i.resuelta,
                       l.codigo_llave,
                       e.id_empleado, e.nombre AS nombre_empleado, e.apellidos AS apellidos_empleado
                FROM incidencias i
                INNER JOIN llaves l ON i.id_llave = l.id_llave
                INNER JOIN empleados e ON i.id_empleado = e.id_empleado
                ORDER BY i.fecha_incidencia ASC
                LIMIT :limit OFFSET :offset";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":limit", (int)$por_pagina, PDO::PARAM_INT);
        $stmt->bindValue(":offset", (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        $incidencias = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Total registros
        $total_sql = "SELECT COUNT(*) FROM incidencias";
        $total = $this->pdo->query($total_sql)->fetchColumn();

        return [
            "incidencias"   => $incidencias,
            "total"         => $total,
            "pagina"        => $pagina,
            "por_pagina"    => $por_pagina,
            "total_paginas" => ceil($total / $por_pagina)
        ];
    }

    // ====== READ por ID ======
    public function obtenerPorId($id_incidencia) {
        $sql = "SELECT * FROM incidencias WHERE id_incidencia = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":id" => $id_incidencia]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ====== UPDATE ======
    public function actualizar(Incidencia $incidencia) {
        $sql = "UPDATE incidencias 
                SET id_llave         = :id_llave,
                    id_empleado      = :id_empleado,
                    tipo_incidencia  = :tipo_incidencia,
                    descripcion      = :descripcion,
                    fecha_incidencia = :fecha_incidencia,
                    resuelta         = :resuelta
                WHERE id_incidencia  = :id_incidencia";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ":id_llave"         => $incidencia->getIdLlave(),
            ":id_empleado"      => $incidencia->getIdEmpleado(),
            ":tipo_incidencia"  => $incidencia->getTipoIncidencia(),
            ":descripcion"      => $incidencia->getDescripcion(),
            ":fecha_incidencia" => $incidencia->getFechaIncidencia(),
            ":resuelta"         => $incidencia->getResuelta() ?? 0,
            ":id_incidencia"    => $incidencia->getIdIncidencia()
        ]);
    }

    // ====== DELETE ======
    public function eliminar($id_incidencia) {
        $sql = "DELETE FROM incidencias WHERE id_incidencia = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([":id" => $id_incidencia]);
    }

    // ====== AUXILIARES (para selects en formularios) ======
    public function listarEmpleados() {
        $sql = "SELECT id_empleado, nombre, apellidos FROM empleados ORDER BY nombre ASC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarLlaves() {
        $sql = "SELECT id_llave, codigo_llave, descripcion FROM llaves ORDER BY codigo_llave ASC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
